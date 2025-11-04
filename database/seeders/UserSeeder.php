<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'admin@local.test'],
            [
                'name' => 'Carlos Cotes',
                'documento' => '100000001',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('nombre', 'Administrador')->first()->id,
            ]
        );

        // SUPERVISOR
        User::updateOrCreate(
            ['email' => 'supervisor@local.test'],
            [
                'name' => 'María Gómez',
                'documento' => '100000002',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('nombre', 'Supervisor')->first()->id,
            ]
        );

        // FUNCIONARIO (GERENTE DE EMPRESA)
        User::updateOrCreate(
            ['email' => 'funcionario@local.test'],
            [
                'name' => 'Javier Torres',
                'documento' => '100000003',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('nombre', 'Funcionario')->first()->id,
            ]
        );

        // EMPLEADO (TRABAJADOR)
        User::updateOrCreate(
            ['email' => 'empleado@local.test'],
            [
                'name' => 'Laura Ruiz',
                'documento' => '100000004',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('nombre', 'Empleado')->first()->id,
            ]
        );

        // VIGILANTE
        User::updateOrCreate(
            ['email' => 'vigilante@local.test'],
            [
                'name' => 'Pedro Díaz',
                'documento' => '100000005',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('nombre', 'Vigilante')->first()->id,
            ]
        );
    }
}
