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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->enum('document_type', ['cedula', 'pasaporte', 'rut']);
            $table->string('document_number');
            $table->date('birth_date');
            $table->text('address');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->text('dietary_restrictions')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->enum('status', ['pending_payment', 'confirmed', 'cancelled']);
            $table->datetime('registration_date');
            $table->decimal('individual_price', 10, 2);
            $table->decimal('price_adjustments', 10, 2)->default(0);
            $table->text('adjustment_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
