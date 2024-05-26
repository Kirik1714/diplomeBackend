<?php

namespace App\Http\Controllers\Main\Pharmacy\Assortment;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(Pharmacy $pharmacy)
    {
        $medicines = $pharmacy->medicines()->paginate(8); // Здесь 10 - количество элементов на странице
        

        return view('pharmacy.assortment.index', compact('pharmacy', 'medicines'));
    }

    public function search(Request $request, Pharmacy $pharmacy)
    {
        $searchQuery = $request->input('search');
        $medicines = $pharmacy->medicines()->where('name', 'like', '%' . $searchQuery . '%')->paginate(4);
    
        return view('pharmacy.assortment.search', compact('pharmacy', 'medicines', 'searchQuery'));
    }
    
}
