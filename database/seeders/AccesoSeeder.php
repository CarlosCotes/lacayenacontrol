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
        // ✅ Obtenemos los trabajadores y funcionarios
        $usuarios = User::whereHas('role', function ($q) {
            $q->whereIn('nombre', ['Empleado', 'Funcionario']);
        })->get();

        // ✅ Obtenemos vigilantes
        $vigilantes = User::whereHas('role', function ($q) {
            $q->where('nombre', 'Vigilante');
        })->get();

        if ($usuarios->isEmpty() || $vigilantes->isEmpty()) {
            $this->command->info('⚠️ No hay usuarios o vigilantes para generar accesos.');
            return;
        }

        foreach ($usuarios as $usuario) {
            // Generamos 5 accesos aleatorios por usuario
            for ($i = 0; $i < 5; $i++) {
                $fechaEntrada = Carbon::now()
                    ->subDays(rand(0, 10))
                    ->setTime(rand(6, 9), rand(0, 59));
                
                $fechaSalida = (clone $fechaEntrada)->addHours(rand(4, 9))->addMinutes(rand(0, 59));

                Acceso::create([
                    'user_id' => $usuario->id,
                    'vigilante_id' => $vigilantes->random()->id,
                    'hora_entrada' => $fechaEntrada,
                    'hora_salida' => $fechaSalida,
                    'tipo' => 'entrada',
                ]);
            }
        }

    }
}
