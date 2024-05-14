<?php

namespace App\Http\Requests\User;

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'is_admin' => 'required|in:0,1',
            'password' => 'required|string|min:5|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Поле "Email" должно быть действительным адресом электронной почты.',
            'email.unique' => 'Пользователь с таким адресом электронной почты уже существует.',
            'is_admin.required' => 'Выбор роли обязателен.',
            'is_admin.in' => 'Значение поля "Роль" должно быть либо 0 (пользователь), либо 1 (администратор).',
            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать не менее :min символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ];
    }
}
