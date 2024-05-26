<?php

namespace App\Http\Controllers\Main\Pharmacy\Order;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\Order;
use Illuminate\Http\Request;

class EditController extends BaseController
{
    public function __invoke(Pharmacy $pharmacy, Order $order)
    {
        // Фильтруем продукты заказа для отображения только тех, которые относятся к выбранной аптеке
        $products = json_decode($order->products, true);
        $filteredProducts = array_filter($products, function ($product) use ($pharmacy) {
            return $product['pharmacy']['id'] == $pharmacy->id;
        });

        return view('pharmacy.order.edit', compact('pharmacy', 'order', 'filteredProducts'));
    }
}
