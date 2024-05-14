<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class MedicineFilter extends AbstractFilter
{
    public const CATEGORIES = 'classification';
    public const FORMS = 'selectedForms';
    public const SORTED = 'sorted';
    public const SUPPLIER = 'supplier';

    protected function getCallbacks(): array
    {
        return [
            self::CATEGORIES => [$this, 'classification'],
            self::FORMS => [$this, 'forms'],
            self::SORTED => [$this, 'sorted'],
            self::SUPPLIER => [$this, 'supplier'],
            'search' => [$this, 'search'], // Добавление метода для поиска


        ];
    }

    protected function classification(Builder $builder, $value)
    {
        $builder->whereIn('classification_id', $value);
    }


    protected function forms(Builder $builder, $value)
    {
        $builder->whereIn('form_id', $value);
    }
    protected function sorted(Builder $builder, $value)
    {
        switch ($value) {
            case 'alphabetical':
                $builder->orderBy('name', 'asc');
                break;
            case 'cheap':
                $builder->leftJoin('medicine_pharmacy', 'medicines.id', '=', 'medicine_pharmacy.medicine_id')
                    ->select('medicines.*')
                    ->selectRaw('(medicines.price * (1 + MAX(medicine_pharmacy.markup_percentage) / 100)) as total_price')
                    ->groupBy('medicines.id')
                    ->orderBy('total_price', 'asc');
                break;
            case 'expensive':
                $builder->leftJoin('medicine_pharmacy', 'medicines.id', '=', 'medicine_pharmacy.medicine_id')
                    ->select('medicines.*')
                    ->selectRaw('(medicines.price * (1 + MAX(medicine_pharmacy.markup_percentage) / 100)) as total_price')
                    ->groupBy('medicines.id')
                    ->orderBy('total_price', 'desc');
                break;
            default:
                $builder->orderBy('id', 'asc');
                break;
        }
    }
    protected function  supplier(Builder $builder, $value)
    {
        $builder->whereIn('supplier_id', $value);
    }
    protected function search(Builder $builder, $value)
{
    if ($value) {
        // Применение условия поиска к запросу
        $builder->where('name', 'like', '%' . $value . '%');
    }
}
}
