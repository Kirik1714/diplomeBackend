<?php

namespace App\Http\Controllers\Main\Medicine\List;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\Medicine;

class IndexController extends BaseController
{
    public function __invoke(Request $request)
    {
        $query = $request->input('query');

        // Проверяем, был ли отправлен запрос поиска
        if ($query) {
            $medicines = Medicine::whereRaw('LOWER(name) LIKE ?', ["%".strtolower($query)."%"])->paginate(2);
        } else {
            // Если запроса поиска не было, отображаем все лекарства
            $medicines = Medicine::paginate(2)->withQueryString();
        }

        return view('medicines.list.index', compact('medicines', 'query'));
    }
    public function search(Request $request)
{
    $query = $request->input('query');

    $medicines = Medicine::whereRaw('LOWER(name) LIKE ?', ["%".strtolower($query)."%"])->paginate(1)->withQueryString();
    

    return view('medicines.list.search', compact('medicines', 'query'));
}
}
