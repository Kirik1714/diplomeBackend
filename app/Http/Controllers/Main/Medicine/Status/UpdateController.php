<?php

namespace App\Http\Controllers\Main\Medicine\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\Status\UpdateRequest;
use App\Models\Status;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request,Status $status){
        $data = $request->validated();
        
        $status->update($data);
        return view('medicines.status.show', compact('status'));


    }
}
