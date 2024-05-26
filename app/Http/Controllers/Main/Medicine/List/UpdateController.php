<?php

namespace App\Http\Controllers\Main\Medicine\List;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\List\UpdateRequest;
use App\Models\Medicine;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class UpdateController extends BaseController
{
  
        // Валидация данных
        public function __invoke(UpdateRequest $request, Medicine $medicine)
        {
            // Валидация данных
            $data = $request->validated();
    
            // Обновление лекарства и ассоциация данных через сервис
            $this->service->updateMedicine($medicine, $data);
    
            return redirect()->route('medicine.list.index');
        }
    
}
