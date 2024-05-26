<?php

namespace App\Http\Controllers\Main\Pharmacy\Assortment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pharmacy\Assortment\UpdateRequest;
use App\Models\MedecinePharmacy;
use App\Models\Pharmacy;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request,Pharmacy $pharmacy,MedecinePharmacy $assortment)
    {
        $data = $request->validated(); 
        $assortment->update($data);
        return redirect()->route('pharmacy.assortment.index',compact('pharmacy'));
    }
}
