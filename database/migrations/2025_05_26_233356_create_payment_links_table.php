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
        Schema::create('payment_links', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->foreignId('passenger_id')->constrained('passengers');
            $table->decimal('amount', 10, 2);
            $table->enum('gateway', ['transbank', 'khipu', 'both']);
            $table->text('description');
            $table->enum('status', ['active', 'used', 'expired']);
            $table->timestamp('expires_at');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_links');
    }
};
