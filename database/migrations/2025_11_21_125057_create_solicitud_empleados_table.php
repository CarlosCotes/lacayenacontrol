<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('solicitudes_empleados', function (Blueprint $table) {
            $table->id();

            // Funcionario que hace la solicitud
            $table->unsignedBigInteger('funcionario_id');

            // Empresa del funcionario (y del empleado solicitado)
            $table->unsignedBigInteger('empresa_id');

            // Datos del empleado que se desea agregar
            $table->string('nombre_empleado');
            $table->string('email')->unique();
            $table->string('documento');

            // Cargo solicitado (por defecto será EMPLEADO al crear el User)
            $table->string('cargo')->default('empleado');

            // Motivo de la solicitud
            $table->text('motivo')->nullable();

            // Estado de la solicitud (pendiente / aprobado / rechazado)
            $table->string('estado')->default('pendiente');

            // Supervisor que aprueba o rechaza
            $table->unsignedBigInteger('supervisor_id')->nullable();

            // Fecha de aprobación
            $table->timestamp('fecha_aprobacion')->nullable();

            // Motivo de rechazo
            $table->text('motivo_rechazo')->nullable();

            $table->timestamps();

            // Relaciones
            $table->foreign('funcionario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_empleados');
    }
};
