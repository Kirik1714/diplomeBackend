<?php

namespace App\Http\Controllers\Main\Pharmacy\Assortment;
use App\Http\Controllers\Controller;
use App\Services\Main\Pharmacy\Assortment\Service;

class BaseController extends Controller
{
    public $service;
    public function __construct(Service $service) {
        $this->service = $service;
    }
   
}