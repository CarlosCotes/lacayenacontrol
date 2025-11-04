<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'nombre' => 'Administrador', 'descripcion' => 'Gestiona usuarios y roles. Acceso total al sistema.'],
            ['id' => 2, 'nombre' => 'Supervisor', 'descripcion' => 'Supervisa accesos y genera reportes.'],
            ['id' => 3, 'nombre' => 'Funcionario', 'descripcion' => 'Gerente o encargado de la empresa.'],
            ['id' => 4, 'nombre' => 'Empleado', 'descripcion' => 'Trabajador de una empresa.'],
            ['id' => 5, 'nombre' => 'Vigilante', 'descripcion' => 'Registra entradas y salidas, valida credenciales.'],
        ];

        foreach ($roles as $r) {
            Role::updateOrCreate(
                ['id' => $r['id']],
                [
                    'nombre' => $r['nombre'],
                    'descripcion' => $r['descripcion'],
                ]
            );
        }
    }
}
