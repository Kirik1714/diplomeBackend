<?php

namespace App\Http\Controllers\Main\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return redirect()->route('pharmacy.assortment.index');
    }
}
