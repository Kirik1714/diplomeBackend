<?php

namespace App\Http\Controllers\Main\Pharmacy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pharmacy\UpdateRequest;


use App\Models\Pharmacy;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request,Pharmacy $pharmacy){
        $data = $request->validated();
        // dd($data);
        $pharmacy->update($data);
        return view('pharmacy.show', compact('pharmacy'));


    }
}
