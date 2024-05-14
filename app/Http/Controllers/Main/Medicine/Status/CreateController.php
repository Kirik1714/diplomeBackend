<?php

namespace App\Http\Controllers\Main\Medicine\Status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('medicines.status.create');
    }
}
