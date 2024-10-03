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
        Schema::table('advertisment_panels', function (Blueprint $table) {
            $table->date('date')->nullable()->after('org_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
