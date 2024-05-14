<?php

namespace App\Http\Controllers\Main\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Pharmacy $pharmacy){

        return view('pharmacy.show',compact('pharmacy'));
    }
}
