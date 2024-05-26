<?php

namespace App\Http\Controllers\Main\Pharmacy\Order;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;

class IndexController extends BaseController
{
    public function __invoke(Pharmacy $pharmacy)
    { 
        // Получаем отфильтрованные заказы
        $filteredOrders = $this->service->getFilteredOrders($pharmacy);

        // Пагинация
        $paginatedOrders = $this->service->paginateOrders($filteredOrders);

        return view('pharmacy.order.index', [
            'pharmacy' => $pharmacy,
            'orders' => $paginatedOrders
        ]);
    }

    public function search(Pharmacy $pharmacy, Request $request)
    {
        $searchQuery = $request->input('search');
        $filteredOrders = $this->service->getFilteredOrders($pharmacy);

        // Поиск по номеру заказа
        if ($searchQuery) {
            $filteredOrders = $filteredOrders->filter(function ($order) use ($searchQuery) {
                return stripos($order->order_number, $searchQuery) !== false;
            });
        }

        // Пагинация
        $paginatedOrders = $this->service->paginateOrders($filteredOrders);

        return view('pharmacy.order.search', [
            'pharmacy' => $pharmacy,
            'orders' => $paginatedOrders,
            'search' => $searchQuery
        ]);
    }
    
}
