<?php

namespace App\Services\Main\Medicine\List;


use App\Models\Medicine;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
class Service
{
    public function storeMedicine(array $data)
    {
        // Объединение значения dosage_value и dosage_unit в поле dosage
        $dosage = $data['dosage_value'] . ' ' . $data['dosage_unit'];
        $data['dosage'] = $dosage;
        unset($data['dosage_value']);
        unset($data['dosage_unit']);

        // Получение идентификаторов формы, классификации, поставщика и статуса
        $formIds = $data['form_id'];
        $classificationId = $data['classification_id'];
        $supplierId = $data['supplier_id'];
        $statusId = $data['status_id'];

        // Получение изображений и сохранение их в хранилище
        $imageUrls = [];
        foreach ($data['image_url'] as $image) {
            $imageUrl = Storage::disk('public')->put('/images', $image);
            $imageUrls[] = asset('storage/' . $imageUrl);
        }

        unset($data['deleted_images'], $data['image_url']);

        // Создание лекарства
        $medicine = Medicine::firstOrCreate(['name' => $data['name']], $data);

        // Привязка формы, классификации, поставщика и статуса к лекарству
        $medicine->form()->associate($formIds);
        $medicine->classification()->associate($classificationId);
        $medicine->supplier()->associate($supplierId);
        $medicine->status()->associate($statusId);

        // Связывание изображений с лекарством
        $images = [];
        foreach ($imageUrls as $imageUrl) {
            $image = Image::create(['image_url' => $imageUrl]);
            $images[] = $image->id;
        }
        $medicine->medicineImages()->attach($images);

        return $medicine;
    }

    public function updateMedicine(Medicine $medicine, array $data)
    {
        // Объединение значения dosage_value и dosage_unit в поле dosage
        $dosage = $data['dosage_value'] . ' ' . $data['dosage_unit'];
        $data['dosage'] = $dosage;
        unset($data['dosage_value']);
        unset($data['dosage_unit']);

        // Получение идентификаторов формы, классификации, поставщика и статуса
        $formIds = $data['form_id'];
        $classificationId = $data['classification_id'];
        $supplierId = $data['supplier_id'];
        $statusId = $data['status_id'];

        // Получение изображений и сохранение их в хранилище
        $imageUrls = [];
        if (isset($data['image_url'])) {
            foreach ($data['image_url'] as $image) {
                $imageUrl = Storage::disk('public')->put('/images', $image);
                $imageUrls[] = asset('storage/' . $imageUrl);
            }
        }

        unset($data['deleted_images'], $data['image_url']);

        // Обновление данных лекарства
        $medicine->update($data);

        // Обновление связей лекарства с формой, классификацией, поставщиком и статусом
        $medicine->form()->associate($formIds);
        $medicine->classification()->associate($classificationId);
        $medicine->supplier()->associate($supplierId);
        $medicine->status()->associate($statusId);

        // Удаление старых изображений
        if (isset($data['deleted_images'])) {
            $deletedImages = $data['deleted_images'];
            if (!is_array($deletedImages)) {
                $deletedImages = explode(',', $deletedImages);
            }
            foreach ($deletedImages as $imageId) {
                Image::destroy($imageId);
            }
        }

        // Связывание новых изображений с лекарством
        foreach ($imageUrls as $imageUrl) {
            $image = Image::create(['image_url' => $imageUrl]);
            $medicine->medicineImages()->attach($image->id);
        }

        return $medicine;
    }
}
