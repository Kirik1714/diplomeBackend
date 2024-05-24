<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected  $table ='orders';


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = self::generateOrderNumber();
        });
    }

    protected static function generateOrderNumber()
    {
        $date = now()->format('Ymd');
        $uniqueId = Str::upper(Str::random(6));

        return 'ORD-' . $date . '-' . $uniqueId;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
