<?php


namespace App\Http\Controllers\Main\Medicine\List;

use App\Http\Controllers\Controller;
use App\Services\Main\Medicine\List\Service;

class BaseController extends Controller
{
    public $service;
    public function __construct(Service $service){
        $this->service = $service;
    }
   
}