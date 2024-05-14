<?php

namespace App\Http\Controllers\Main\Medicine\Form;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\Form\UpdateRequest;


use App\Models\Form;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request,Form $form){
        $data = $request->validated();
        
        $form->update($data);
        return view('medicines.forms.show', compact('form'));


    }
}
