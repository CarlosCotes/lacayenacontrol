<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Empresa;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Obtener empresas
        $laCayena = Empresa::where('nombre', 'La Cayena')->first();
        $torres = Empresa::where('nombre', 'Torres S.A.S.')->first();
        $caribe = Empresa::where('nombre', 'Servicios del Caribe LTDA')->first();
        $innovatech = Empresa::where('nombre', 'Innovatech Solutions')->first();

        if (!$laCayena || !$torres || !$caribe || !$innovatech) {
            dd('⚠️ Error: Ejecuta primero el seeder de EmpresaSeeder');
        }

        // ✅ ADMINISTRADOR
        User::updateOrCreate(
            ['email' => 'admin@local.test'],
            [
                'name' => 'Carlos Cotes',
                'documento' => '100000001',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('nombre', 'Administrador')->first()->id,
                'empresa_id' => $laCayena->id,
            ]
        );

        // ✅ SUPERVISOR
        User::updateOrCreate(
            ['email' => 'supervisor@local.test'],
            [
                'name' => 'María Gómez',
                'documento' => '100000002',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('nombre', 'Supervisor')->first()->id,
                'empresa_id' => $laCayena->id,
            ]
        );

        // ✅ VIGILANTE
        User::updateOrCreate(
            ['email' => 'vigilante@local.test'],
            [
                'name' => 'Pedro Díaz',
                'documento' => '100000003',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('nombre', 'Vigilante')->first()->id,
                'empresa_id' => $laCayena->id,
            ]
        );

        // ✅ FUNCIONARIOS (uno por empresa)
        $funcionarios = [
            [
                'email' => 'funcionario1@local.test',
                'name' => 'Javier Torres',
                'empresa' => $torres,
            ],
            [
                'email' => 'funcionario2@local.test',
                'name' => 'Laura Ruiz',
                'empresa' => $caribe,
            ],
            [
                'email' => 'funcionario3@local.test',
                'name' => 'Andrés Mejía',
                'empresa' => $innovatech,
            ],
            [
                'email' => 'funcionario4@local.test',
                'name' => 'Diana Pineda',
                'empresa' => $laCayena,
            ],
        ];

        foreach ($funcionarios as $index => $f) {
            User::updateOrCreate(
                ['email' => $f['email']],
                [
                    'name' => $f['name'],
                    'documento' => '20000000' . ($index + 1),
                    'password' => Hash::make('123456'),
                    'role_id' => Role::where('nombre', 'Funcionario')->first()->id,
                    'empresa_id' => $f['empresa']->id,
                ]
            );
        }

        // ✅ TRABAJADORES (uno por empresa)
        $trabajadores = [
            [
                'email' => 'trabajador1@local.test',
                'name' => 'Carlos Ramírez',
                'empresa' => $torres,
            ],
            [
                'email' => 'trabajador2@local.test',
                'name' => 'Sandra Medina',
                'empresa' => $caribe,
            ],
            [
                'email' => 'trabajador3@local.test',
                'name' => 'Luis Morales',
                'empresa' => $innovatech,
            ],
            [
                'email' => 'trabajador4@local.test',
                'name' => 'Verónica Díaz',
                'empresa' => $laCayena,
            ],
        ];

        foreach ($trabajadores as $index => $t) {
            User::updateOrCreate(
                ['email' => $t['email']],
                [
                    'name' => $t['name'],
                    'documento' => '30000000' . ($index + 1),
                    'password' => Hash::make('123456'),
                    'role_id' => Role::where('nombre', 'Empleado')->first()->id,
                    'empresa_id' => $t['empresa']->id,
                ]
            );
        }
    }
}
