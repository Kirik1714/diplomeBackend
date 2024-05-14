<?php

namespace App\Http\Controllers\Main\Medicine\List;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\List\UpdateRequest;
use App\Models\Medicine;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Medicine $medicine)
    {
        // Валидация данных
        $data = $request->validated();

        // dd($data);
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
        if ($request->hasFile('image_url')) {
            foreach ($request->file('image_url') as $image) {
                $imageUrl = Storage::disk('public')->put('/images', $image);
                $imageUrls[] = asset('storage/' . $imageUrl);
            }
        }

        unset($data['deleted_images'],$data['image_url']);
        // Обновление данных лекарства
        $medicine->update($data);

        // Обновление связей лекарства с формой, классификацией, поставщиком и статусом
        $medicine->form()->associate($formIds);
        $medicine->classification()->associate($classificationId);
        $medicine->supplier()->associate($supplierId);
        $medicine->status()->associate($statusId);

        
if ($request->has('deleted_images')) {
    $deletedImages = $request->deleted_images;
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

        return redirect()->route('medicine.list.index');
    }
}
