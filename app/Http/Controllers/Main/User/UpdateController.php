<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user)
    {
        // Получение проверенных данных из запроса
        $data = $request->validated();
        
        // Преобразование значения is_admin в булево
        $data['is_admin'] = (bool) $data['is_admin'];
        
           // Проверка, было ли отправлено поле пароля
           if (!empty($data['password'])) {
            // Если пароль был отправлен, хешируем его и добавляем к данным для обновления
            $data['password'] = bcrypt($data['password']);
        } else {
            // Если пароль не был отправлен, удаляем его из данных для обновления
            unset($data['password']);
        }
        // Обновление пользователя с полученными данными
        $user->update($data);
        // dd($user);  

        // Возврат представления с обновленным пользователем
        return view('user.show', compact('user'));
    }
}
