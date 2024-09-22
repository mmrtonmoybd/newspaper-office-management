<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyCirculation extends Model
{
    protected $fillable = [
        'monthly_circulation_repen_id', 'district', 'send_quantity',
        'monthly_bill', 'paid_bill', 'paid_date', 'due_bill', 'extra_due_bill', 'comment',
    ];

    public function representative()
    {
        return $this->belongsTo(MonthlyCirculationRepen::class, 'monthly_circulation_repen_id');
    }

    // Eloquent Events for cascading logic
    protected static function booted()
    {
        // Create Event Logic
        static::creating(function ($circulation) {
            self::handleDueBill($circulation, true); // Handle creation logic
        });

        // Update Event Logic
        static::updating(function ($circulation) {
            self::handleDueBill($circulation, false); // Handle update logic
        });

        static::created(function ($circulation) {
            // After creating, adjust future records
            self::adjustFutureRecords($circulation);
        });

        static::updated(function ($circulation) {
            // After updating, adjust future records
            self::adjustFutureRecords($circulation);
        });

        // Delete Event Logic
        static::deleted(function ($circulation) {
            // Adjust future records on deletion
            $nextCirculation = MonthlyCirculation::where('monthly_circulation_repen_id', $circulation->monthly_circulation_repen_id)
                ->where('id', '>', $circulation->id)
                ->orderBy('id', 'asc')
                ->first();

            $previousCirculation = MonthlyCirculation::where('monthly_circulation_repen_id', $circulation->monthly_circulation_repen_id)
                ->where('id', '<', $circulation->id)
                ->orderBy('id', 'desc')
                ->first();

            if ($previousCirculation && $nextCirculation) {
                // Recalculate future records starting from the one after the deleted record
                self::adjustFutureRecords($previousCirculation);
            } elseif ($nextCirculation) {
                // No previous circulation found, calculate the next circulation due_bill considering extra_due_bill
                $currentDue = $nextCirculation->monthly_bill - $nextCirculation->paid_bill;

                // Add extra_due_bill in the calculation
                $nextCirculation->due_bill = $currentDue + $nextCirculation->extra_due_bill;
                $nextCirculation->save();

                // Adjust future records
                self::adjustFutureRecords($nextCirculation);
            }
        });
    }

    // Handle due bill logic for creating or updating
    protected static function handleDueBill($circulation, $isCreating)
    {
        if ($isCreating) {
            // Handle when creating a new record
            $previousCirculation = MonthlyCirculation::where('monthly_circulation_repen_id', $circulation->monthly_circulation_repen_id)
                ->orderBy('id', 'desc')
                ->first();
        } else {
            // Handle when updating an existing record
            $previousCirculation = MonthlyCirculation::where('monthly_circulation_repen_id', $circulation->monthly_circulation_repen_id)
                ->where('id', '<', $circulation->id)
                ->orderBy('id', 'desc')
                ->first();
        }

        $currentDue = $circulation->monthly_bill - $circulation->paid_bill;

        // Consider the extra_due_bill provided by the user
        if ($isCreating) {
            // If user provides extra_due_bill during creation
            $circulation->due_bill = $previousCirculation
                ? $currentDue + $previousCirculation->due_bill + $circulation->extra_due_bill
                : $currentDue + $circulation->extra_due_bill;
        } else {
            // If updating an existing record
            $circulation->due_bill = $previousCirculation
                ? $currentDue + $previousCirculation->due_bill + $circulation->extra_due_bill
                : $currentDue + $circulation->extra_due_bill;
        }
    }

    // Adjust future records for cascading due balances
    protected static function adjustFutureRecords($circulation)
    {
        $nextCirculations = MonthlyCirculation::where('monthly_circulation_repen_id', $circulation->monthly_circulation_repen_id)
            ->where('id', '>', $circulation->id)
            ->orderBy('id', 'asc')
            ->get();

        $previousDue = $circulation->due_bill;

        foreach ($nextCirculations as $nextCirculation) {
            $currentDue = $nextCirculation->monthly_bill - $nextCirculation->paid_bill;
            $nextCirculation->due_bill = $currentDue + $previousDue + $nextCirculation->extra_due_bill;
            $nextCirculation->save();
            $previousDue = $nextCirculation->due_bill;
        }
    }
}
