<?php

namespace App\Http\Requests\Medicine\List;

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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'packaging' => ['required', 'string'],
            'dosage_value' => ['required', 'string'],
            'dosage_unit' => ['required', 'in:мг,г,мл,мг/мл,мг/г'],
            'atx' => ['required', 'string'],
            'image_url' => ['required', 'array'],
            'image_url.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'status_id' => ['required', 'exists:statuses,id'],
            'form_id' => ['required', 'exists:forms,id'],
            'classification_id' => ['required', 'exists:classifications,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'structure' => ['required', 'string'],
            'indications' => ['required', 'string'],
            'contraindications' => ['required', 'string'],
            'methods' => ['required', 'string'],
            'release' => ['required', 'string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'name.string' => 'Поле "Название" должно быть строкой.',
            'name.max' => 'Поле "Название" не может быть длиннее :max символов.',
            'description.required' => 'Поле "Описание" обязательно для заполнения.',
            'description.string' => 'Поле "Описание" должно быть строкой.',
            'price.required' => 'Поле "Цена" обязательно для заполнения.',
            'price.numeric' => 'Поле "Цена" должно быть числовым значением.',
            'packaging.required' => 'Поле "Кол-во препарата в упаковке" обязательно для заполнения.',
            'dosage_value.required' => 'Поле "Дозировка" обязательно для заполнения.',
            'atx.required' => 'Поле "Фармакотерапевтическая группа, ATX" обязательно для заполнения.',
            'atx.string' => 'Поле "Фармакотерапевтическая группа, ATX" должно быть строкой.',
            'packaging.string' => 'Поле "Кол-во препарата в упаковке" должно быть строкой.',
            'dosage_value.string' => 'Поле "Дозировка" должно быть строкой.',
            'dosage_unit.in' => 'Выбранное значение для поля "Дозировка" недопустимо.',
            'image_url.required' => 'Поле "Изображения" обязательно для заполнения.',
            'image_url.*.image' => 'Каждое изображение должно быть файлом изображения.',
            'image_url.*.mimes' => 'Разрешены только файлы изображений форматов: jpeg, png, jpg, gif.',
            'image_url.*.max' => 'Максимальный размер каждого изображения не должен превышать :max Кб.',
            'status_id.required' => 'Поле "Статус" обязательно для выбора.',
            'status_id.exists' => 'Выбранный статус не существует.',
            'form_id.required' => 'Поле "Форма" обязательно для выбора.',
            'form_id.exists' => 'Выбранная форма не существует.',
            'classification_id.required' => 'Поле "Классификация" обязательно для выбора.',
            'classification_id.exists' => 'Выбранная классификация не существует.',
            'supplier_id.required' => 'Поле "Поставщик" обязательно для выбора.',
            'supplier_id.exists' => 'Выбранный поставщик не существует.',
            'structure.required' => 'Поле "Состав" обязательно для заполнения.',
            'indications.required' => 'Поле "Показания к применению" обязательно для заполнения.',
            'contraindications.required' => 'Поле "Противопоказания" обязательно для заполнения.',
            'methods.required' => 'Поле "Способы применения и дозы" обязательно для заполнения.',
            'release.required' => 'Поле "Упаковка и условия отпуска из аптек" обязательно для заполнения.',
           
        ];
    }
}
