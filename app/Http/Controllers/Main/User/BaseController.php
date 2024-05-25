<?php


namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Services\Main\User\Service;

class BaseController extends Controller
{
    public $service;
    public function __construct(Service $service){
        $this->service = $service;
    }
   
}