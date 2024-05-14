<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }
}
