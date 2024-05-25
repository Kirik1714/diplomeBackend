<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $users = $this->service->getAllUsersPaginated(5); // Получение пользователей с пагинацией

        return view('user.index', compact('users'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');
        $users = $this->service->searchUsers($searchQuery, 5); // Поиск пользователей с пагинацией

        return view('user.search', compact('users', 'searchQuery'));
    }
}
