<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressPlate extends Model
{
    use HasFactory;

    protected $fillable = ['published_date', 'advance_paid', 'cut_amount', 'daily_plate', 'new_plate', 'total_plate'];
}
