<?php

namespace App\Http\Controllers\Main\Medicine\Form;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Form $form)
    {
        $form->delete();
        return redirect()->route('medicine.form.index');
    }
}
