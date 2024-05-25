<?php

namespace App\Http\Controllers\Main\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Pharmacy $pharmacy)
    { 
        // Получаем все заказы
        $orders = Order::all();

        // Фильтруем заказы, чтобы включить только те продукты, которые относятся к выбранной аптеке
        $filteredOrders = $orders->filter(function ($order) use ($pharmacy) {
            $products = json_decode($order->products, true);
            $filteredProducts = array_filter($products, function ($product) use ($pharmacy) {
                return $product['pharmacy']['id'] == $pharmacy->id;
            });

            return !empty($filteredProducts);
        });

        
        $orderData = $filteredOrders->sortBy('created_at')->groupBy(function ($order) {
            return $order->created_at->format('M Y'); // Форматируем дату в формат Месяц Год
        })->map(function ($groupedOrders) {
            $totalOrders = $groupedOrders->count();
            $cancelledOrders = $groupedOrders->filter(function ($order) {
                return $order->status === 'Отменен';
            })->count();
        
            // Получаем список самых заказываемых лекарств в этом месяце
            $topMedicines = $groupedOrders->flatMap(function ($order) {
                return collect(json_decode($order->products))->pluck('medicine.name');
            })->countBy()->sortDesc()->take(5); // Берем топ-5 самых заказываемых лекарств
        
            return [
                'total_orders' => $totalOrders,
                'cancelled_orders' => $cancelledOrders,
                'top_medicines' => $topMedicines
            ];
        });


        return view('pharmacy.show', [
            'pharmacy' => $pharmacy,
            'orderData' => $orderData
        ]);
    }
}
