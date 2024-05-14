<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|min:5',
            'is_admin' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'email.required' => 'Поле "Email" обязательно для заполнения',
            'email.email' => 'Поле "Email" должно содержать действительный адрес электронной почты',
            'email.unique' => 'Пользователь с таким email уже существует',  
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.min' => 'Поле "Пароль" должно содержать не менее 5 символов',
        ];
    }
}
