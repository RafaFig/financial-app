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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('account_id')->index();
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->decimal('total_amount', 15, 2)->index();
            $table->enum('status', ['pending', 'canceled', 'paid', 'partial'])->index()->default('pending');
            $table->enum('payment_method', ['fixed', 'installment', 'unique'])->index()->default('unique');
            $table->enum('periodicity', ['daily', 'weekly', 'monthly', 'yearly'])->index()->default('monthly');
            $table->integer('installments')->index()->nullable();
            $table->date('start_date')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
