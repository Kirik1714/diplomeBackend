<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Pharmacy;

class IndexController extends Controller
{
    public function __invoke()
    {
        $medicines = Medicine::all();
        $pharmacies = Pharmacy::all();
        return view('main.index', compact('medicines', 'pharmacies'));
    }
}
