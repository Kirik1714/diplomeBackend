<?php

namespace App\Http\Controllers\Main\Pharmacy\Assortment;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Models\MedecinePharmacy;

class DeleteController extends Controller
{

    public function __invoke(Pharmacy $pharmacy, $assortment)
    {
      $assortment=MedecinePharmacy::where('pharmacy_id',$pharmacy->id)->where('medicine_id',$assortment)->first();
       
        $assortment->delete();
        return view('pharmacy.assortment.index', compact('pharmacy')); 
    }
}
