<?php

namespace App\Http\Controllers\Main\Medicine\List;

use App\Http\Controllers\Controller;

use App\Models\Medicine;


class DeleteController extends Controller
{
    public function __invoke(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.list.index');
    }
}
