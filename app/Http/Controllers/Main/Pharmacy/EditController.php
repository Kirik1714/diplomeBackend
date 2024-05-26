<?php

namespace App\Http\Controllers\Main\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class EditController extends BaseController
{
    public function __invoke(Pharmacy $pharmacy)
    {
        return view('pharmacy.edit',compact('pharmacy'));
    }
}
