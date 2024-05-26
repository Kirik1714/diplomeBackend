<?php

namespace App\Services\Main\Pharmacy\Order;

use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\MedecinePharmacy;


class Service
{
    public function getFilteredOrders(Pharmacy $pharmacy)
    {
        $orders = Order::with('user')->get();

        // Фильтруем заказы, чтобы включить только те продукты, которые относятся к выбранной аптеке
        $filteredOrders = $orders->filter(function ($order) use ($pharmacy) {
            $products = json_decode($order->products, true);
            $filteredProducts = array_filter($products, function ($product) use ($pharmacy) {
                return $product['pharmacy']['id'] == $pharmacy->id;
            });

            if (!empty($filteredProducts)) {
                $order->products = json_encode($filteredProducts);
                $order->total_price = array_sum(array_map(function ($product) {
                    return $product['pharmacy']['total_price'] * $product['count'];
                }, $filteredProducts));

                // Проверка статусов продуктов
                $allProductsReady = true;
                foreach ($filteredProducts as $product) {
                    if (($product['status'] ?? 'Принят в обработку') !== 'Готов') {
                        $allProductsReady = false;
                        break;
                    }
                }

                // Обновляем основной статус заказа, если все статусы продуктов "Готов"
                if ($allProductsReady) {
                    $order->status = 'Готов к выдаче';
                    $order->save();
                }

                return true;
            }
            return false;
        });

        return $filteredOrders;
    }

    public function paginateOrders($orders, $perPage = 5)
    {
        $sortedOrders = $orders->sortByDesc('created_at');

        // Пагинация
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $sortedOrders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        return new LengthAwarePaginator($currentItems, $sortedOrders->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'query' => request()->query() // добавляем параметры запроса к URL пагинации
        ]);
    }

    public function updateOrderStatus(Pharmacy $pharmacy, Order $order, $newStatus)
    {
        $oldStatus = $order->status;

        // Обновляем статус в продуктах заказа
        $products = json_decode($order->products, true);
        foreach ($products as &$product) {
            if ($product['pharmacy']['id'] == $pharmacy->id) {
                $product['status'] = $newStatus;
            }
        }

        // Если новый статус "Отменен", возвращаем товары на склад
        if ($newStatus === 'Отменен' && $oldStatus !== 'Отменен') {
            DB::transaction(function () use ($products, $pharmacy) {
                foreach ($products as $product) {
                    if ($product['pharmacy']['id'] == $pharmacy->id) {
                        $medicineId = $product['medicine']['id'];
                        $count = $product['count'];

                        $medicinePharmacy = MedecinePharmacy::where('medicine_id', $medicineId)
                            ->where('pharmacy_id', $pharmacy->id)
                            ->first();

                        if ($medicinePharmacy) {
                            $medicinePharmacy->quantity += $count;

                            // Обновляем доступность
                            if ($medicinePharmacy->quantity > 0) {
                                $medicinePharmacy->availability = 'в наличии';
                            }

                            $medicinePharmacy->save();
                        }
                    }
                }
            });
        }

        $order->products = json_encode($products);
        $order->status = $newStatus;
        $order->save();
    }
    
}
