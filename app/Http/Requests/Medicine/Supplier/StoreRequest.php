<?php

namespace App\Http\Requests\Medicine\Supplier;

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
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'postal_code' => ['required', 'string', 'max:10'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Наименование организации" обязательно для заполнения.',
            'address.required' => 'Поле "Адрес" обязательно для заполнения.',
            'city.required' => 'Поле "Город" обязательно для заполнения.',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'postal_code.required' => 'Поле "Почтовый индекс" обязательно для заполнения.',
            'max' => 'Поле :attribute не может быть длиннее :max символов.',
        ];
    }
}
