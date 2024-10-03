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
        Schema::create('ad_as', function (Blueprint $table) {
            $table->id();
            $table->string('details')->nullable();
            $table->string('subject')->nullable();
            $table->date('published_date')->nullable();
            $table->string('amount')->nullable();
            $table->string('size')->nullable();
            $table->string('as')->nullable();
            $table->string('page')->nullable();
            $table->longText('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_as');
    }
};
