<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    public function __invoke(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
