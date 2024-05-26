<?php

namespace App\Http\Controllers\Main\Medicine\List;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    public function __invoke(Medicine  $medicine){
 
        return view('medicines.list.show',compact('medicine'));
    }
}
