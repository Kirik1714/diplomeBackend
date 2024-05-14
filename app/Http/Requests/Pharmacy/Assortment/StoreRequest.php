<?php

namespace App\Http\Requests\Pharmacy\Assortment;

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
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'medicine_id' => 'required|exists:medicines,id',
            'markup_percentage' => 'required|numeric|min:0', // Добавляем правило для процента наценки
            'availability' => 'required|in:в наличии,под заказ,нет в наличии',
            'quantity' => 'required|integer|min:0',
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
            'pharmacy_id.required' => 'Выберите аптеку',
            'pharmacy_id.exists' => 'Выбранная аптека не существует',
            'medicine_id.required' => 'Выберите лекарство',
            'medicine_id.exists' => 'Выбранное лекарство не существует',
            'markup_percentage.required' => 'Укажите процент наценки',
            'markup_percentage.numeric' => 'Процент наценки должен быть числом',
            'markup_percentage.min' => 'Процент наценки должен быть не меньше :min',
            'availability.required' => 'Выберите доступность',
            'availability.in' => 'Выберите корректное значение для доступности',
            'quantity.required' => 'Укажите количество',
            'quantity.integer' => 'Количество должно быть целым числом',
            'quantity.min' => 'Количество должно быть не менее :min',
        ];
    }
    protected function prepareForValidation()
    {
        $quantity = $this->input('quantity');
    
        if ((int)$quantity === 0) {
            $this->merge(['availability' => 'нет в наличии']); 
   
        }
    }
}
