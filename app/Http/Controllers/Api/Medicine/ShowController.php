<?php

namespace App\Http\Controllers\Api\Medicine;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke($id)
    {
        // Находим лекарство по его ID вместе с его изображениями и ценами из аптек
        $medicine = Medicine::with(['images', 'pharmacies'])->find($id);

        if (!$medicine) {
            return response()->json(['message' => 'Лекарство не найдено'], 404);
        }

        // Преобразуем данные лекарства в массив для JSON-ответа
        $medicineArray = [
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
            'form' => $medicine->form ? $medicine->form->name : null,
            'classification' => $medicine->classification ? $medicine->classification->name : null,
            'supplier' => $medicine->supplier ? $medicine->supplier->name : null,
            'images' => $medicine->images->pluck('image_url'), // Здесь 'image_url' - поле, в котором хранится URL изображения
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
                    'total_price' => $medicine->price * (1 + $pharmacy->pivot->markup_percentage / 100), // Вычисляем полную цену с учетом наценки
                ];
            }),
        ];

        return response()->json($medicineArray);
    }
}
