<?php

namespace App\Services\Api\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\MedecinePharmacy;

class Service
{
   
    public function createOrder(array $data)
    {
        DB::beginTransaction();
        try {
            // Декодируем JSON строку с продуктами
            $products = json_decode($data['products'], true);

            // Проходим по каждому продукту, уменьшаем количество лекарства
            foreach ($products as $product) {
                $medicineId = $product['medicine']['id'];
                $pharmacyId = $product['pharmacy']['id'];
                $quantity = $product['count'];

                // Находим запись в таблице medicine_pharmacy и уменьшаем количество
                $medicinePharmacy = MedecinePharmacy::where('medicine_id', $medicineId)
                    ->where('pharmacy_id', $pharmacyId)
                    ->first();

                if ($medicinePharmacy && $medicinePharmacy->quantity >= $quantity) {
                    $medicinePharmacy->quantity -= $quantity;

                    // Обновляем поле availability, если quantity становится равно 0
                    if ($medicinePharmacy->quantity == 0) {
                        $medicinePharmacy->availability = 'нет в наличии';
                    }

                    $medicinePharmacy->save();
                } else {
                    throw new \Exception('Недостаточное количество товара на складе');
                }
            }

            // Создаем заказ с декодированными продуктами
            $data['products'] = json_encode($products);
            $order = Order::create($data);

            Log::info('Order created:', $data);

            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create order:', ['error' => $e->getMessage()]);
            throw new \Exception('Не удалось создать заказ: ' . $e->getMessage());
        }
    }

    public function getOrdersByUser($userId)
    {
        $orders = Order::where('user_id', $userId)->get();

        foreach ($orders as $order) {
            $order['products'] = json_decode($order['products'], true);
        }

        return $orders;
    }
}
