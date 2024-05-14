<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        
        $data=$request->validated();

        $data['password']=Hash::make($data['password']);
        // $user = User::where('email', $data['email'])->first();
        // if($user){
        //     return response()->json(['message' => 'Пользователь с таким email уже существует']);
        // }
        $user=User::create($data);
        $token = auth()->tokenById($user->id);
        return response()->json(['access_token' => $token, 'message' => 'Регистрация прошла успешно']);
    }
}
