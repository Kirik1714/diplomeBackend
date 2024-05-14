<?php

namespace App\Http\Controllers\Main\Medicine\Form;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
    
        $forms=Form::all();
        return view('medicines.forms.index',compact('forms'));
    }
}
