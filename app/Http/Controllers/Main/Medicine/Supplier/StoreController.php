<?php

namespace App\Http\Controllers\Main\Medicine\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\Supplier\StoreRequest;
use App\Models\Form;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        
        $data = $request->validated();
        $supplier=Supplier::firstOrCreate($data);
        return redirect()->route('medicine.supplier.index');
    
    }
}
