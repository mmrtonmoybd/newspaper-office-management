<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertismentPanel extends Model
{
    use HasFactory;

    protected $fillable = ['advertisment_start_date', 'advertisment_end_date', 'org_name', 'date', 'amount', 'paid_date', 'comment'];
}
