<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OrderRequest;
use App\Models\MedecinePharmacy;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __invoke(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

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
            Order::create($data);

            Log::info('Order created:', $data);

            DB::commit();
            return response()->json(['message' => 'Заказ успешно оформлен']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create order:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Не удалось создать заказ: ' . $e->getMessage()], 500);
        }
    }

    public function getOrderByUser($id)
    {
        $orders = Order::where('user_id', $id)->get();

        foreach ($orders as $order) {
            $order['products'] = json_decode($order['products'], true);
        }

        return response()->json($orders);
    }
}
