<?php

namespace App\Http\Requests\Pharmacy\Assortment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'availability' => 'required|in:в наличии,под заказ,нет в наличии',
            'quantity' => 'required|integer|min:0', // Добавляем минимальное значение 0
            'markup_percentage' => 'required|numeric|min:0',
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
            'availability.required' => 'Поле доступности обязательно для заполнения.',
            'availability.in' => 'Недопустимое значение для поля доступности.',
            'quantity.required' => 'Поле количества обязательно для заполнения.',
            'quantity.integer' => 'Поле количества должно быть целым числом.',
            'quantity.min' => 'Поле количества должно быть неотрицательным.',
            'markup_percentage.required' => 'Поле процента наценки обязательно для заполнения.',
            'markup_percentage.numeric' => 'Поле процента наценки должно быть числом.',
            'markup_percentage.min' => 'Поле процента наценки должно быть неотрицательным.',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    protected function prepareForValidation()
    {
        $quantity = $this->input('quantity');
    
        if ((int)$quantity === 0) {
            $this->merge(['availability' => 'нет в наличии']); // Обновляем значение availability
   
        }
    }
}
