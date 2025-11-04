<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehiculo;
use App\Models\VehiculoAcceso;
use App\Models\User;

class VehiculoAccesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vigilante = User::where('role_id', 5)->first(); // Asegúrate que exista un vigilante

        $vehiculos = Vehiculo::all();

        foreach ($vehiculos as $vehiculo) {
            // Generar entre 1 y 3 accesos aleatorios por vehículo
            $accesos = rand(1, 3);
            for ($i = 0; $i < $accesos; $i++) {
                VehiculoAcceso::create([
                    'vehiculo_id' => $vehiculo->id,
                    'vigilante_id' => $vigilante->id,
                    'tipo' => 'entrada',
                    'hora_entrada' => now()->subDays(rand(0, 10))->addMinutes(rand(0, 59)),
                    'hora_salida' => now()->subDays(rand(0, 10))->addHours(rand(1, 5)),
                ]);
            }
        }
    }
}
