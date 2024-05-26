<?php

namespace App\Http\Controllers\Main\Pharmacy\Assortment;

use App\Http\Controllers\Controller;
use App\Models\MedecinePharmacy;
use App\Models\Medicine;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class EditController extends BaseController
{

    public function __invoke(Pharmacy $pharmacy,  $assortment) 
    {

      $assortment=MedecinePharmacy::where('pharmacy_id',$pharmacy->id)->where('medicine_id',$assortment)->first();
   
        return view('pharmacy.assortment.edit', compact('assortment','pharmacy'));
    }
}
