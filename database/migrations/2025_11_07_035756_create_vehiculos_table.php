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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa')->unique();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('tipo')->nullable(); // Auto, moto, camión...
            
            // Relación directa con usuario (propietario)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            // Si quieres asociar el vehículo a una empresa directamente
            $table->foreignId('empresa_id')->nullable()->constrained('empresas')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
