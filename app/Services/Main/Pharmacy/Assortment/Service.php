<?php

namespace App\Services\Main\Pharmacy\Assortment;
use App\Models\Pharmacy;
use App\Models\MedecinePharmacy;

class Service
{
    public function addAssortment(array $data)
    {
        $pharmacy = Pharmacy::find($data['pharmacy_id']);

        // Проверяем, существует ли запись с данными аптеки и лекарства
        $existingAssortment = MedecinePharmacy::where('pharmacy_id', $data['pharmacy_id'])
            ->where('medicine_id', $data['medicine_id'])
            ->first();

        // Если запись уже существует, возвращаем ошибку
        if ($existingAssortment) {
            return [
                'status' => 'error',
                'message' => 'Такой товар уже добавлен.',
                'pharmacy' => $pharmacy
            ];
        }

        // Создаем новую запись, если не существует
        MedecinePharmacy::create($data);

        return [
            'status' => 'success',
            'pharmacy' => $pharmacy
        ];
    }
}