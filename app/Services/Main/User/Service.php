<?php

namespace App\Services\Main\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class Service
{
   
    public function update(User $user, array $data): User
    {
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

        // Обновление пользователя с полученными данными и возврат обновленного пользователя
        $user->update($data);

        return $user;
    }
    public function getAllUsersPaginated($perPage)
    {
        return User::paginate($perPage);
    }

    public function searchUsers($searchQuery, $perPage)
    {
        return User::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere(DB::raw("IF(is_admin=1, 'админ', 'пользователь')"), 'like', '%' . $searchQuery . '%')
            ->orWhere('email', 'like', '%' . $searchQuery . '%')
            ->paginate($perPage);
    }
}
