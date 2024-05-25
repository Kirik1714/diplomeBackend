<?php

namespace App\Models;

use App\Models\Traits\Filterable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Medicine extends Model
{   
    use HasFactory;
    use Filterable; // Используем трейт Filterable

    protected $table = 'medicines'; 
    protected $guarded = [];

    public function medicineImages(){
      return $this->belongsToMany(Image::class, 'medicines_images', 'medicine_id', 'image_id');
    }
    public function form(){
      return $this->belongsTo(Form::class); 
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'medicines_images', 'medicine_id', 'image_id');
    }
    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, 'medicine_pharmacy')
                    ->withPivot('availability', 'markup_percentage', 'quantity');
    }
 



}
