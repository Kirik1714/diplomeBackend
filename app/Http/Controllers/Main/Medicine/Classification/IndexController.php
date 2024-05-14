<?php

namespace App\Http\Controllers\Main\Medicine\Classification;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Http\Request;

class IndexController extends Controller
{
   public function __invoke()
   {
      $classifications=Classification::all();
      return view('medicines.classification.index',compact('classifications'));
   } 
}
