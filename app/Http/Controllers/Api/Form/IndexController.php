<?php

namespace App\Http\Controllers\Api\Form;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $forms = Form::all();
        return response()->json($forms);
    }
}
