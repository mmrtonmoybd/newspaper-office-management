<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('press_inks', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'color')->nullable();
            $table->date('purchased_date')->nullable();
            $table->decimal('amount', 10, 2)->nullable()->default('0.00');
            $table->string('quantity')->nullable();
            $table->date('ink_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('press_inks');
    }
};
