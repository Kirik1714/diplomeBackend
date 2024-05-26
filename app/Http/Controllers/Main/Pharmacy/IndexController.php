<?php

namespace App\Http\Controllers\Main\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $pharmacies = Pharmacy::paginate(4);
        
        return view('pharmacy.index',compact('pharmacies'));  
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');
        $pharmacies = Pharmacy::where('name', 'like', '%' . $searchQuery . '%')->paginate(1);
    
        return view('pharmacy.search', compact('pharmacies', 'searchQuery'));
    }
}
 