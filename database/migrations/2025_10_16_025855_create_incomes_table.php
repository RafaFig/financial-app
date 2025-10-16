<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('account_id')->index();
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2)->index();
            $table->decimal('net_amount', 15, 2)->index();
            $table->enum('periodicity', ['daily', 'weekly', 'monthly', 'yearly'])->index()->default('monthly');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
