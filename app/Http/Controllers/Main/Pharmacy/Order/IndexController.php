<?php

namespace App\Http\Controllers\Main\Pharmacy\Order;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;

class IndexController extends Controller
{
    public function __invoke(Pharmacy $pharmacy)
    { 
        // Получаем все заказы
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

        // Сортируем заказы по дате создания в обратном порядке (сначала новые)
        $sortedOrders = $filteredOrders->sortByDesc('created_at');

        // Пагинация
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $sortedOrders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedOrders = new LengthAwarePaginator($currentItems, $sortedOrders->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view('pharmacy.order.index', [
            'pharmacy' => $pharmacy,
            'orders' => $paginatedOrders
        ]);
    }
    public function search(Pharmacy $pharmacy,Request $request){

        $searchQuery = $request->input('search');
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

        // Поиск по номеру заказа
        if ($searchQuery) {
            $filteredOrders = $filteredOrders->filter(function ($order) use ($searchQuery) {
                return stripos($order->order_number, $searchQuery) !== false;
            });
        }
        $sortedOrders = $filteredOrders->sortByDesc('created_at');

        // Пагинация
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $sortedOrders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedOrders = new LengthAwarePaginator($currentItems, $sortedOrders->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'query' => request()->query() // добавляем параметры запроса к URL пагинации
        ]);

        return view('pharmacy.order.search', [
            'pharmacy' => $pharmacy,
            'orders' => $paginatedOrders,
            'search' => $searchQuery
        ]);
    }
        
    
}
