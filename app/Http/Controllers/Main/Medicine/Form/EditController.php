<?php

namespace App\Http\Controllers\Main\Medicine\Form;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Form $form)
    {
        return view('medicines.forms.edit',compact('form'));
    }
}
