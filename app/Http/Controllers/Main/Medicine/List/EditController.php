<?php

namespace App\Http\Controllers\Main\Medicine\List;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Models\Form;
use App\Models\Medicine;
use App\Models\Status;
use App\Models\Supplier;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Medicine $medicine)
    {
        $statuses = Status::all();
        $classifications = Classification::all();
        $suppliers = Supplier::all();
        $forms = Form::all();
        return view('medicines.list.edit',compact('medicine','statuses','classifications','suppliers','forms'));
    }
}
