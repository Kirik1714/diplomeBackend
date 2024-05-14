<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:5'],
        ];
    }
    public function messages():array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'name.max' => 'Поле "Имя" не должно превышать 255 символов',
            'email.required' => 'Поле "Email" обязательно для заполнения',
            'email.email' => 'Поле "Email" должно быть действительным адресом электронной почты',
            'email.max' => 'Поле "Email" не должно превышать 255 символов',
            'email.unique' => 'Введенный Email уже используется.',
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.string' => 'Поле "Пароль" должно быть строкой',
            'password.min' => 'Пароль должен содержать минимум 5 символов',
            'password.confirmed' => 'Пароли не совпадают',
            'password_confirmation.required' => 'Поле "Подтверждение пароля" обязательно для заполнения',
            'password_confirmation.string' => 'Поле "Подтверждение пароля" должно быть строкой',
            'password_confirmation.min' => 'Подтверждение пароля должно содержать минимум 5 символов',
        ];
}
}