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
        Schema::create('vehiculo_solicitudes', function (Blueprint $table) {
            $table->id();

            // Usuario dueño del vehículo (empleado)
            $table->unsignedBigInteger('user_id');

            // Funcionario que genera la solicitud
            $table->unsignedBigInteger('funcionario_id');

            // Datos del vehículo
            $table->string('placa');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('tipo'); // 🚗 CARRO, MOTO, CAMION, ETC.

            // Información administrativa
            $table->string('motivo');
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada'])
                  ->default('pendiente');
            $table->text('razon_rechazo')->nullable();

            $table->timestamps();

            // Relaciones
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('funcionario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos_solicitudes');
    }
};
