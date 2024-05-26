<?php

namespace App\Http\Controllers\Main\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class ShowController extends BaseController 
{
    public function __invoke(Pharmacy $pharmacy)
    { 
        // Получаем все заказы
        $filteredOrders = $this->service->getFilteredOrders($pharmacy);
        
        // Получаем статистику заказов
        $orderData = $this->service->getOrderStatistics($filteredOrders);

        return view('pharmacy.show', [
            'pharmacy' => $pharmacy,
            'orderData' => $orderData
        ]);
    }
}
