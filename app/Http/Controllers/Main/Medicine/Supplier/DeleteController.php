<?php

namespace App\Http\Controllers\Main\Medicine\Supplier;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('medicine.supplier.index');
    }
}
