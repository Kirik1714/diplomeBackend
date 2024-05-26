<?php

namespace App\Http\Controllers\Main\Pharmacy;
use App\Http\Controllers\Controller;
use App\Services\Main\Pharmacy\Service;

class BaseController extends Controller
{
    public $service;
    public function __construct(Service $service) {
        $this->service = $service;
    }
   
}