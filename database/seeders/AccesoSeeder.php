<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Acceso;
use App\Models\User;
use Carbon\Carbon;

class AccesoSeeder extends Seeder
{
    public function run()
    {
        $usuarios = User::where('role_id', 1)->pluck('id')->toArray();
        $vigilantes = User::where('role_id', 5)->pluck('id')->toArray();

        if(empty($usuarios) || empty($vigilantes)){
            $this->command->info('No hay usuarios o vigilantes para generar accesos.');
            return;
        }

        foreach ($usuarios as $userId) {
            for ($i = 0; $i < 5; $i++) {
                $fechaEntrada = Carbon::now()->subDays(rand(0, 10))->setTime(rand(6, 9), rand(0, 59));
                $fechaSalida = (clone $fechaEntrada)->addHours(rand(1, 8));

                Acceso::create([
                    'user_id' => $userId,
                    'vigilante_id' => $vigilantes[array_rand($vigilantes)],
                    'hora_entrada' => $fechaEntrada,
                    'hora_salida' => $fechaSalida,
                    'tipo' => 'entrada',
                ]);
            }
        }
    }
}
