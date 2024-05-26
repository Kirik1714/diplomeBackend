<?php

namespace App\Http\Controllers\Main\Medicine\List;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\List\StoreRequest;
use App\Models\Medicine;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        // Валидация данных
        $data = $request->validated();

        // Создание лекарства и ассоциация данных через сервис
        $this->service->storeMedicine($data);

        return redirect()->route('medicine.list.index');
    }
}
