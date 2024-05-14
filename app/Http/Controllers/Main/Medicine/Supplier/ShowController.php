<?php

namespace App\Http\Controllers\Main\Medicine\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Supplier $supplier){

        return view('medicines.suppliers.show',compact('supplier'));
        
    }
}
