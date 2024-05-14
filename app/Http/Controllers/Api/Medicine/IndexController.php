<?php

namespace App\Http\Controllers\Api\Medicine;

use App\Http\Controllers\Controller;
use App\Http\Filters\MedicineFilter;
use App\Http\Requests\Api\FilterRequest;
use App\Models\Medicine;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getAllMedicines(FilterRequest $request)
    {
        $data = $request->validated();
        $medicines = Medicine::with(['images', 'pharmacies'])
            ->paginate(2, ['*'], 'page', $data['page']);
    
        // Получаем коллекцию лекарств из объекта пагинации
        $medicinesCollection = collect($medicines->items());
    
        // Преобразуем коллекцию лекарств в массив для JSON-ответа
        $medicinesArray = $medicinesCollection->map(function ($medicine) {
            return [
                'id' => $medicine->id,
                'name' => $medicine->name,
                'description' => $medicine->description,
                'price' => $medicine->price,
                'dosage' => $medicine->dosage,
                'packaging' => $medicine->packaging,
                'atx' => $medicine->atx,
                'structure' => $medicine->structure,
                'indications' => $medicine->indications,
                'contraindications' => $medicine->contraindications,
                'methods' => $medicine->methods,
                'release' => $medicine->release,
                'status_id' => $medicine->status_id,
                'form_id' => $medicine->form_id,
                'classification_id' => $medicine->classification_id,
                'supplier_id' => $medicine->supplier_id,
                'images' => $medicine->images->pluck('image_url'),
                'pharmacies' => $medicine->pharmacies->map(function ($pharmacy) use ($medicine) {
                    return [
                        'id' => $pharmacy->id,
                        'name' => $pharmacy->name,
                        'city' => $pharmacy->city,
                        'address' => $pharmacy->address,
                        'phone' => $pharmacy->phone,
                        'work_start' => $pharmacy->work_start,
                        'work_end' => $pharmacy->work_end,
                        'availability' => $pharmacy->pivot->availability,
                        'markup_percentage' => $pharmacy->pivot->markup_percentage,
                        'quantity' => $pharmacy->pivot->quantity,
                        'total_price' => $medicine->price * (1 + $pharmacy->pivot->markup_percentage / 100),
                    ];
                }),
            ];
        });
    
        $response = [
            'data' => $medicinesArray,
            'current_page' => $medicines->currentPage(),
            'per_page' => $medicines->perPage(),
            'total' => $medicines->total(),
        ];
    
        return response()->json($response);
    }
    public function filterMedicines(FilterRequest $request)
    {
      
        $data = $request->validated();
        $filter = app()->make(MedicineFilter::class, ['queryParams' => array_filter($data)]);
        
        // Получаем все лекарства вместе с их изображениями и ценами из аптек
        $medicines = Medicine::filter($filter)->with(['images', 'pharmacies'])->paginate(2, ['*'], 'page', $data['page']);

          // Получаем коллекцию лекарств из объекта пагинации
        $medicinesCollection = collect($medicines->items());
        // Преобразуем коллекцию лекарств в массив для JSON-ответа
        $medicinesArray = $medicinesCollection->map(function ($medicine) {
            return [
                'id' => $medicine->id,
                'name' => $medicine->name,
                'description' => $medicine->description,
                'price' => $medicine->price,
                'dosage' => $medicine->dosage,
                'packaging' => $medicine->packaging,
                'atx' => $medicine->atx,
                'structure' => $medicine->structure,
                'indications' => $medicine->indications,
                'contraindications' => $medicine->contraindications,
                'methods' => $medicine->methods,
                'release' => $medicine->release,
                'status_id' => $medicine->status_id,
                'form_id' => $medicine->form_id,
                'classification_id' => $medicine->classification_id,
                'supplier_id' => $medicine->supplier_id,
                'images' => $medicine->images->pluck('image_url'),
                'pharmacies' => $medicine->pharmacies->map(function ($pharmacy) use ($medicine) {
                    return [
                        'id' => $pharmacy->id,
                        'name' => $pharmacy->name,
                        'city' => $pharmacy->city,
                        'address' => $pharmacy->address,
                        'phone' => $pharmacy->phone,
                        'work_start' => $pharmacy->work_start,
                        'work_end' => $pharmacy->work_end,
                        'availability' => $pharmacy->pivot->availability,
                        'markup_percentage' => $pharmacy->pivot->markup_percentage,
                        'quantity' => $pharmacy->pivot->quantity,
                        'total_price' => $medicine->price * (1 + $pharmacy->pivot->markup_percentage / 100),
                    ];
                }),
            ];
        });
    
        $response = [
            'data' => $medicinesArray,
            'current_page' => $medicines->currentPage(),
            'per_page' => $medicines->perPage(),
            'total' => $medicines->total(),
        ];
    
        return response()->json($response);
    }
}