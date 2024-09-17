<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('press_plates', function (Blueprint $table) {
            $table->id();
            $table->date('published_date')->nullable();
            $table->decimal('advance_paid', 10, 2)->default(0)->nullable();
            $table->decimal('cut_amount', 10, 2)->default(0)->nullable();
            $table->decimal('daily_plate', 10, 2)->nullable();
            $table->decimal('new_plate', 10, 2)->nullable();
            $table->decimal('total_plate', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('press_plates');
    }
};
