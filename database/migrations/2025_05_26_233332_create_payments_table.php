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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id')->constrained('passengers');
            $table->decimal('amount', 10, 2);
            $table->datetime('payment_date')->nullable();
            $table->enum('payment_method', ['online', 'cash', 'transfer']);
            $table->enum('gateway', ['transbank', 'khipu'])->nullable();
            $table->string('gateway_transaction_id')->nullable();
            $table->text('gateway_response')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded']);
            $table->integer('installment_number')->default(1);
            $table->integer('total_installments')->default(1);
            $table->date('due_date')->nullable();
            $table->string('invoice_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
