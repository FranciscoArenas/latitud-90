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
        Schema::create('passenger_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id')->constrained('passengers')->onDelete('cascade');
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->decimal('individual_price', 10, 2); // Precio específico para esta combinación pasajero-programa
            $table->decimal('price_adjustments', 10, 2)->default(0);
            $table->text('adjustment_reason')->nullable();
            $table->enum('status', ['pending_payment', 'confirmed', 'cancelled'])->default('pending_payment');
            $table->datetime('registration_date');
            $table->timestamps();

            // Evitar duplicados: un pasajero no puede estar en el mismo programa dos veces
            $table->unique(['passenger_id', 'program_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passenger_program');
    }
};
