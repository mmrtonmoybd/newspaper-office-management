<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCirculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'sell_date', 'buyer_name', 'sell_quantity',
        'per_price', 'total_price',
    ];

    protected static function booted()
    {
        static::saving(function ($circulation) {
            $circulation->total_price = number_format($circulation->sell_quantity * $circulation->per_price, 2);
        });
    }
}
