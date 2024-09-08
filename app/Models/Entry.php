<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = ['calculation_id', 'type', 'description', 'amount'];

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
