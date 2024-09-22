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
        Schema::create('daily_circulations', function (Blueprint $table) {
            $table->id();
            $table->date('sell_date')->nullable();
            $table->string('buyer_name')->nullable();
            $table->decimal('sell_quantity', 10, 0)->nullable();
            $table->decimal('per_price', 10, 2)->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_circulations');
    }
};
