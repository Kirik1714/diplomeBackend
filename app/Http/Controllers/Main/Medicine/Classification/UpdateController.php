<?php

namespace App\Http\Controllers\Main\Medicine\Classification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\Classification\UpdateRequest;
use App\Models\Classification;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request,Classification $classification){
        $data=$request->validated();
        $classification->update($data);
        return redirect()->route('medicine.classification.index');

    }
}
