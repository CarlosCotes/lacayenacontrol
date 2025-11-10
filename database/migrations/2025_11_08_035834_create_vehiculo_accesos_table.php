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
        Schema::create('vehiculo_accesos', function (Blueprint $table) {
            $table->id();

            // 🔹 Relación con el vehículo
            $table->foreignId('vehiculo_id')->constrained()->onDelete('cascade');

            // 🔹 Vigilante que registró el acceso
            $table->foreignId('vigilante_id')->constrained('users')->onDelete('cascade');

            // 🔹 Empresa (opcional, pero útil para reportes por compañía)
            $table->foreignId('empresa_id')->nullable()->constrained()->onDelete('cascade');

            // 🔹 Tipo de registro (entrada o salida)
            $table->enum('tipo', ['entrada', 'salida']);

            // 🔹 Horarios
            $table->timestamp('hora_entrada')->nullable();
            $table->timestamp('hora_salida')->nullable();

            // 🔹 Observaciones opcionales
            $table->text('observacion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo_accesos');
    }
};
