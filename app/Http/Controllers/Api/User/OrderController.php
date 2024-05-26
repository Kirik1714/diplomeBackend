<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OrderRequest;
use App\Models\MedecinePharmacy;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function __invoke(OrderRequest $request)
    {
        try {
            $data = $request->validated();
            $this->service->createOrder($data);
            return response()->json(['message' => 'Заказ успешно оформлен']);
        } catch (\Exception $e) {
            Log::error('Failed to create order:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Не удалось создать заказ: ' . $e->getMessage()], 500);
        }
    }

    public function getOrderByUser($id)
    {
        try {
            $orders = $this->service->getOrdersByUser($id);
            return response()->json($orders);
        } catch (\Exception $e) {
            Log::error('Failed to get orders for user:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Не удалось получить заказы пользователя: ' . $e->getMessage()], 500);
        }
    }
}
