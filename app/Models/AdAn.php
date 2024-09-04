<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdAn extends Model
{
    use HasFactory;

    protected $fillable = ['details', 'subject', 'published_date', 'amount', 'size', 'page', 'an', 'comment'];
}
