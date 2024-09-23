<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdAs extends Model
{
    use HasFactory;

    protected $fillable = ['details', 'subject', 'date', 'published_date', 'amount', 'size', 'page', 'as', 'comment'];
}
