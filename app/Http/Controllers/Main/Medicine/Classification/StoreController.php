<?php

namespace App\Http\Controllers\Main\Medicine\Classification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\Classification\StoreRequest;
use App\Models\Classification;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {

      $data = $request->validated();
      
      $classification = Classification::firstOrCreate($data);

      return redirect()->route('medicine.classification.index');
    }
}
