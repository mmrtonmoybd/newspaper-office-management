<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyCirculation extends Model
{
    use HasFactory;

    protected $fillable = ['monthly_circulation_repen_id ', 'district', 'send_quantity', 'monthly_bill', 'paid_bill', 'paid_date', 'due_bill', 'comment'];

    public function monthlycirculationrepen()
    {
        return $this->belongsTo(MonthlyCirculationRepen::class);
    }
}
