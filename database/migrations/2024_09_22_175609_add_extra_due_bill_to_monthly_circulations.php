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
        Schema::table('monthly_circulations', function (Blueprint $table) {
            $table->decimal('extra_due_bill', 10, 2)->nullable()->default(0)->after('due_bill');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
