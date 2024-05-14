<?php

namespace App\Http\Controllers\Main\Medicine\Classification;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Http\Request;

class DeleteController extends Controller
{

    public function __invoke(Classification $classification)
    {
        $classification->delete();
        return redirect()->route('medicine.classification.index');
    }
}
