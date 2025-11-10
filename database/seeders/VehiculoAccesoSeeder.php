<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;
use App\Models\VehiculoAcceso;
use App\Models\User;
use Illuminate\Support\Carbon;

class VehiculoAccesoSeeder extends Seeder
{
    public function run(): void
        {
            $vigilantes = User::whereHas('role', fn($q) => $q->where('nombre', 'Vigilante'))->get();

            if ($vigilantes->isEmpty()) {
                dd('⚠️ No hay vigilantes registrados.');
            }

            $vehiculos = Vehiculo::all();

            foreach ($vehiculos as $vehiculo) {
                $vigilante = $vigilantes->random(); // asignar vigilante aleatorio
                $numAccesos = rand(1, 3);

                for ($i = 0; $i < $numAccesos; $i++) {
                    $diasAtras = rand(1, 10);
                    $horaEntrada = Carbon::now()->subDays($diasAtras)->setTime(rand(6, 22), rand(0, 59));
                    $horaSalida = (clone $horaEntrada)->addHours(rand(1, 5))->addMinutes(rand(0, 59));

                    VehiculoAcceso::create([
                        'vehiculo_id' => $vehiculo->id,
                        'vigilante_id' => $vigilante->id,
                        'empresa_id' => $vehiculo->empresa_id, // ⚡ importante
                        'tipo' => 'entrada',
                        'hora_entrada' => $horaEntrada,
                        'hora_salida' => $horaSalida,
                    ]);
                }
            }
        }
}

