<?php

namespace App\Http\Requests\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */ 
    public function authorize(): bool
    {
        return true; // Предполагается, что авторизация обрабатывается в контроллере или через политики
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20', // Предполагается, что телефон имеет формат строки
            'work_start' => 'required|date_format:H:i', // Формат времени ЧЧ:ММ:СС
            'work_end' => 'required|date_format:H:i|after:work_start', // Формат времени ЧЧ:ММ:СС и должно быть после начала работы
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
            'name.required' => 'Поле Название обязательно для заполнения',
            'name.string' => 'Поле Название должно быть строкой',
            'name.max' => 'Поле Название не должно превышать :max символов',
            'city.required' => 'Поле Город обязательно для заполнения',
            'city.string' => 'Поле Город должно быть строкой',
            'city.max' => 'Поле Город не должно превышать :max символов',
            'address.required' => 'Поле Адрес обязательно для заполнения',
            'address.string' => 'Поле Адрес должно быть строкой',
            'address.max' => 'Поле Адрес не должно превышать :max символов',
            'phone.required' => 'Поле Телефон обязательно для заполнения',
            'phone.string' => 'Поле Телефон должно быть строкой',
            'phone.max' => 'Поле Телефон не должно превышать :max символов',
            'work_start.required' => 'Поле Время начала работы обязательно для заполнения',
            'work_start.date_format' => 'Поле Время начала работы должно быть в формате ЧЧ:ММ:СС',
            'work_end.required' => 'Поле Время окончания работы обязательно для заполнения',
            'work_end.date_format' => 'Поле Время окончания работы должно быть в формате ЧЧ:ММ:СС',
            'work_end.after' => 'Поле Время окончания работы должно быть позже времени начала работы',
        ];
    }
}
