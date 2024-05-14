<?php

namespace App\Http\Requests\Medicine\Classification;

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
            'description' => ['required', 'string'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Поле наименование обязательно для заполнения.',
            'name.string' => 'Поле имя должно быть строкой.',
            'name.max' => 'Поле имя не может быть длиннее :max символов.',
            'description.required' => 'Поле описание обязательно для заполнения.',
            'description.string' => 'Поле описание должно быть строкой.',
        ];
    }
}
