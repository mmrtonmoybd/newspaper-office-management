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
        Schema::create('press_papers', function (Blueprint $table) {
            $table->id();
            $table->string('roll')->nullable();
            $table->string('roll_weight')->nullable();
            $table->decimal('published_order', 10, 2)->default(0)->nullable();
            $table->decimal('wastage', 10, 2)->default(0)->nullable();
            $table->decimal('total', 10, 2)->default(0)->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('press_papers');
    }
};
