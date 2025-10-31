<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nombre' => 'Administrador', 'descripcion' => 'Acceso total'],
            ['nombre' => 'Supervisor', 'descripcion' => 'Supervisa procesos'],
            ['nombre' => 'Funcionario', 'descripcion' => 'Usuario interno'],
            ['nombre' => 'Vigilante', 'descripcion' => 'Control de entradas/salidas'],
        ]);
    }
}
