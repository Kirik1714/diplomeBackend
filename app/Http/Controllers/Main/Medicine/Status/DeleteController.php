<?php

namespace App\Http\Controllers\Main\Medicine\Status;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Status;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Status $status)
    {
        $status->delete();
        return redirect()->route('medicine.status.index');
    }
}
