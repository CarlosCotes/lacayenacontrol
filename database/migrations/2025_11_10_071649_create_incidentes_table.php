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
    Schema::create('incidentes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('vigilante_id'); // Quién reporta
        $table->unsignedBigInteger('user_id')->nullable(); // Si es relacionado con un usuario
        $table->string('tipo'); // alerta o incidente
        $table->text('descripcion');
        $table->string('estado')->default('pendiente'); // pendiente, revisado, cerrado
        $table->timestamps();

        $table->foreign('vigilante_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidentes');
    }
};
