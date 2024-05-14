<?php

namespace App\Http\Controllers\Main\Medicine\Classification;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Classification $classification)
    {
     
        return view('medicines.classification.edit',compact('classification'));
    }
}
