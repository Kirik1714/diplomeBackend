<?php

namespace App\Http\Controllers\Main\Medicine\Status;
use App\Http\Controllers\Controller;
use App\Models\Status;


class EditController extends Controller
{
    public function __invoke(Status $status) 
    {
        return view('medicines.status.edit',compact('status'));
    }
}
