<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(User $user){

        return view('user.show',compact('user'));
    }
}
