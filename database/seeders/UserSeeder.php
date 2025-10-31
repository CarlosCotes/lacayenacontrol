<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Carlos Cotes',
            'email' => 'admin@local.test',
            'password' => Hash::make('123456'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Supervisor Prueba',
            'email' => 'supervisor@local.test',
            'password' => Hash::make('123456'),
            'role_id' => 2,
        ]);

        // FUNCIONARIO
        User::create([
            'name' => 'Funcionario Ejemplo',
            'email' => 'funcionario@email.com',
            'password' => Hash::make('12345678'),
            'role_id' => 3,
        ]);

        // VIGILANTE
        User::create([
            'name' => 'Vigilante Puerta',
            'email' => 'vigilante@email.com',
            'password' => Hash::make('12345678'),
            'role_id' => 4,
        ]);
    }
}
