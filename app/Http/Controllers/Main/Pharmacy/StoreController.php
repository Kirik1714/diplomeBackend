<?php

namespace App\Http\Controllers\Main\Pharmacy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pharmacy\StoreRequest;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
   
        $pharmacy = Pharmacy::firstOrCreate($data);

        return redirect()->route('pharmacy.index');
    }
}
