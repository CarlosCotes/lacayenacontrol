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
        DB::table('roles')->insert([
            'nombre' => 'Empleado',
            'descripcion' => 'Rol asignado a los trabajadores de la empresa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('roles')->where('nombre', 'Empleado')->delete();
    }
};
