<?php

namespace App\Http\Controllers\Main\Pharmacy\Assortment;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class CreateController extends BaseController
{
    public function __invoke(Pharmacy $pharmacy)
    {
        $medicines = Medicine::all();
        return view('pharmacy.assortment.create',compact('medicines','pharmacy'));
    }
}
