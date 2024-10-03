<?php

use App\Models\MonthlyCirculationRepen;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monthly_circulations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MonthlyCirculationRepen::class)->constrained()->cascadeOnDelete();
            $table->string('district')->nullable();
            $table->decimal('send_quantity', 10, 0)->nullable();
            $table->decimal('monthly_bill', 10, 2)->nullable();
            $table->decimal('paid_bill', 10, 2)->nullable();
            $table->date('paid_date')->nullable();
            $table->decimal('due_bill', 10, 2)->nullable();
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_circulations');
    }
};
