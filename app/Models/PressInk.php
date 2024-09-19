<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressInk extends Model
{
    use HasFactory;

    protected $fillable = ['color', 'purchased_date', 'amount', 'quantity', 'ink_end'];
}
