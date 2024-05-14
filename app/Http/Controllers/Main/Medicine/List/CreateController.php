<?php

namespace App\Http\Controllers\Main\Medicine\List;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Models\Form;
use App\Models\Status;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke()
    {
        $statuses = Status::all();
        $classifications = Classification::all();
        $suppliers = Supplier::all();
        $forms = Form::all();

        return view('medicines.list.create',compact('statuses','classifications','suppliers','forms'));
    }
}
