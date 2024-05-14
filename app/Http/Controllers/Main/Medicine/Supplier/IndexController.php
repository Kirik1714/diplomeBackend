<?php

namespace App\Http\Controllers\Main\Medicine\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $suppliers = Supplier::all();
        return view('medicines.suppliers.index',compact('suppliers'));
    }
}
