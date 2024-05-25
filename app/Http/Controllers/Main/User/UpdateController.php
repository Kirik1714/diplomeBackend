<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Services\Main\User\Service;

class UpdateController extends BaseController
{
   

    public function __invoke(UpdateRequest $request, User $user)
    {
        // Получение проверенных данных из запроса
        $data = $request->validated();

        // Вызов метода сервиса для обновления пользователя
        $user = $this->service->update($user, $data);

        // Возврат представления с обновленным пользователем
        return view('user.show', compact('user'));
    }
}
