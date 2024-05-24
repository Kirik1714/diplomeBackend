<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $table = 'pharmacies';
    protected $guarded = [];

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'medicine_pharmacy')
                    ->withPivot('availability', 'quantity' , 'markup_percentage')
                    ->withTimestamps();
    }

   
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
