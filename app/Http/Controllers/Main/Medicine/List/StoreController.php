<?php

namespace App\Http\Controllers\Main\Medicine\List;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\List\StoreRequest;
use App\Models\Medicine;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        // Валидация данных
        $data = $request->validated();
        // dd($data);

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

        unset( $data['deleted_images'], $data['image_url']);

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

        return redirect()->route('medicine.list.index');
    }
}
