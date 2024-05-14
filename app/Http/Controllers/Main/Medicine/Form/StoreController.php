<?php

namespace App\Http\Controllers\Main\Medicine\Form;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\Form\StoreRequest;
use App\Models\Form;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        
        $data = $request->validated();
        $form=Form::firstOrCreate($data);
        return redirect()->route('medicine.form.index');
    
    }
}
