<?php

namespace App\Http\Controllers\Main\Medicine\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\Supplier\UpdateRequest;
use App\Models\Form;
use App\Models\Supplier;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request,Supplier $supplier){
        $data = $request->validated();
        
        $supplier->update($data);
        return view('medicines.suppliers.show', compact('supplier'));


    }
}
