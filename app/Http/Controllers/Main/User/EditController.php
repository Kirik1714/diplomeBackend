<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EditController extends BaseController
{
    public function __invoke(User $user)
    {
        return view('user.edit',compact('user'));
    }
}
