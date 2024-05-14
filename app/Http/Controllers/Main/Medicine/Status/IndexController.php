<?php

namespace App\Http\Controllers\Main\Medicine\Status;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $statutes=Status::all();

        return view('medicines.status.index',compact('statutes'));
    }
}
