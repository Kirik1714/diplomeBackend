<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        $medicines = Medicine::all(); 
        $pharmacies = Pharmacy::all();
        $users = User::all();
        $orderData = $this->getOrderData();

        return view('main.index', compact('medicines', 'pharmacies', 'users', 'orderData'));
    }

    private function getOrderData()
    {
        // Группировка заказов по месяцам
        $ordersByMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Группировка отмененных заказов по месяцам
        $canceledOrdersByMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('status', 'Отменен')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Подготовка данных для графика
        $labels = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        $data = array_fill(0, 12, 0);
        $canceledData = array_fill(0, 12, 0);

        foreach ($ordersByMonth as $month => $count) {
            $data[$month - 1] = $count;
        }

        foreach ($canceledOrdersByMonth as $month => $count) {
            $canceledData[$month - 1] = $count;
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'canceledData' => $canceledData
        ];
    }
}
