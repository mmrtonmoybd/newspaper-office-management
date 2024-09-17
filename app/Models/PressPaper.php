<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressPaper extends Model
{
    use HasFactory;

    protected $fillable = ['roll', 'roll_weight', 'published_order', 'wastage', 'total', 'date'];
}
