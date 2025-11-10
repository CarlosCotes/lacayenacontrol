<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;
use App\Models\User;
use App\Models\Empresa;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        // 🧩 Obtener usuarios (funcionarios o trabajadores)
        $javier = User::where('name', 'Javier Torres')->first();
        $laura = User::where('name', 'Laura Ruiz')->first();
        $andres = User::where('name', 'Andrés Mejía')->first();

        // 🧩 Obtener empresas
        $torres = Empresa::where('nombre', 'Torres S.A.S.')->first();
        $caribe = Empresa::where('nombre', 'Servicios del Caribe LTDA')->first();
        $innovatech = Empresa::where('nombre', 'Innovatech Solutions')->first();

        // 🚗 Vehículos personales (de usuarios)
        $vehiculosPersonales = [
            [
                'placa' => 'ABC123',
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'tipo' => 'Auto',
                'user_id' => $javier?->id,
                'empresa_id' => null,
            ],
            [
                'placa' => 'XYZ456',
                'marca' => 'Yamaha',
                'modelo' => 'FZ25',
                'tipo' => 'Moto',
                'user_id' => $laura?->id,
                'empresa_id' => null,
            ],
            [
                'placa' => 'LMN789',
                'marca' => 'Mazda',
                'modelo' => 'CX-5',
                'tipo' => 'Camioneta',
                'user_id' => $andres?->id,
                'empresa_id' => null,
            ],
        ];

        // 🚚 Vehículos de empresa
        $vehiculosEmpresas = [
            [
                'placa' => 'TOR111',
                'marca' => 'Chevrolet',
                'modelo' => 'NHR',
                'tipo' => 'Camión',
                'user_id' => null,
                'empresa_id' => $torres?->id,
            ],
            [
                'placa' => 'CAR222',
                'marca' => 'Hyundai',
                'modelo' => 'Tucson',
                'tipo' => 'Auto',
                'user_id' => null,
                'empresa_id' => $caribe?->id,
            ],
            [
                'placa' => 'INN333',
                'marca' => 'Ford',
                'modelo' => 'Transit',
                'tipo' => 'Furgoneta',
                'user_id' => null,
                'empresa_id' => $innovatech?->id,
            ],
        ];

        // 🚀 Insertar todo
        foreach (array_merge($vehiculosPersonales, $vehiculosEmpresas) as $vehiculo) {
            Vehiculo::updateOrCreate(['placa' => $vehiculo['placa']], $vehiculo);
        }
    }
}
