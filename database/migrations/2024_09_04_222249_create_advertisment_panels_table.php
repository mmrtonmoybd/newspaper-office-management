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
        Schema::create('advertisment_panels', function (Blueprint $table) {
            $table->id();
            $table->date('advertisment_start_date')->nullable();
            $table->date('advertisment_end_date')->nullable();
            $table->string('org_name')->nullable();
            $table->string('amount')->nullable();
            $table->date('paid_date')->nullable();
            $table->longText('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisment_panels');
    }
};
