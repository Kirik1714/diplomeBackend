<?php

namespace App\Http\Controllers\Main\Pharmacy\Assortment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pharmacy\Assortment\StoreRequest;
use App\Models\MedecinePharmacy;
use App\Models\Pharmacy;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
       
        $pharmacy = Pharmacy::find($data['pharmacy_id']);
        
        // Проверяем, существует ли запись с данными аптеки и лекарства
        $existingAssortment = MedecinePharmacy::where('pharmacy_id', $data['pharmacy_id'])
            ->where('medicine_id', $data['medicine_id'])
            ->first();

        // Если запись уже существует, возвращаем ошибку
        if ($existingAssortment) {
            return redirect()->back()->withErrors(['medicine_id' => 'Такой товар уже добавлен.'])->withInput();
        }
        
        // Создаем новую запись, если не существует
        $assortments = MedecinePharmacy::create($data);
        return redirect()->route('pharmacy.assortment.index', $pharmacy);
        // return view('pharmacy.assortment.index', compact('pharmacy'));
    }
}

