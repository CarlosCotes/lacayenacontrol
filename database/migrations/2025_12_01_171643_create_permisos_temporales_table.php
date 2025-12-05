<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permisos_temporales', function (Blueprint $table) {
            $table->id();

            // Funcionario que solicita el permiso
            $table->unsignedBigInteger('funcionario_id');
            $table->foreign('funcionario_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('nombre_visitante');
            $table->string('documento_visitante');

            // Fechas del permiso
            $table->dateTime('fecha_ingreso');
            $table->dateTime('fecha_salida');

            // Motivo de la solicitud
            $table->text('motivo')->nullable();

            // Estado del permiso
            $table->string('estado')->default('pendiente'); 
            // Valores esperados: pendiente, aprobado, rechazado

            // Supervisor que aprueba o rechaza
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos_temporales');
    }
};
