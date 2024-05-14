<?php

namespace App\Http\Controllers\Main\Medicine\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\Status\StoreRequest;
use App\Models\Status;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        
        $data = $request->validated();
        $status=Status::firstOrCreate($data);
        return redirect()->route('medicine.status.index');
    
    }
}
