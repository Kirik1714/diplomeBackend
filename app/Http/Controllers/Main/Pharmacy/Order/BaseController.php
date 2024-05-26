<?php

namespace App\Http\Controllers\Main\Pharmacy\Order;
use App\Http\Controllers\Controller;
use App\Services\Main\Pharmacy\Order\Service;

class BaseController extends Controller
{
    public $service;
    public function __construct(Service $service) {
        $this->service = $service;
    }
   
}