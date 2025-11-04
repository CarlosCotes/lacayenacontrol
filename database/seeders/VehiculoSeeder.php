<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehiculo;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehiculos = [
            ['placa' => 'ABC123', 'marca' => 'Toyota', 'modelo' => 'Corolla', 'tipo' => 'Auto', 'propietario_tipo' => 'persona', 'propietario_nombre' => 'Juan Perez'],
            ['placa' => 'XYZ987', 'marca' => 'Honda', 'modelo' => 'Civic', 'tipo' => 'Auto', 'propietario_tipo' => 'empresa', 'propietario_nombre' => 'Transportes XYZ'],
            ['placa' => 'MOTO01', 'marca' => 'Yamaha', 'modelo' => 'R1', 'tipo' => 'Moto', 'propietario_tipo' => 'persona', 'propietario_nombre' => 'Carlos Cotes'],
            ['placa' => 'CAMION1', 'marca' => 'Mercedes', 'modelo' => 'Actros', 'tipo' => 'Camión', 'propietario_tipo' => 'empresa', 'propietario_nombre' => 'Logística S.A.'],
            ['placa' => 'AUTO55', 'marca' => 'Ford', 'modelo' => 'Focus', 'tipo' => 'Auto', 'propietario_tipo' => 'persona', 'propietario_nombre' => 'Ana Martínez'],
            ['placa' => 'XYZ123', 'marca' => 'Chevrolet', 'modelo' => 'Spark', 'tipo' => 'Auto', 'propietario_tipo' => 'empresa', 'propietario_nombre' => 'Servicios ABC'],
            ['placa' => 'MOTO99', 'marca' => 'Suzuki', 'modelo' => 'GSX', 'tipo' => 'Moto', 'propietario_tipo' => 'persona', 'propietario_nombre' => 'Luis Gómez'],
            ['placa' => 'CAM99', 'marca' => 'Volvo', 'modelo' => 'FH', 'tipo' => 'Camión', 'propietario_tipo' => 'empresa', 'propietario_nombre' => 'Transportes Global'],
            ['placa' => 'AUTO88', 'marca' => 'Nissan', 'modelo' => 'Sentra', 'tipo' => 'Auto', 'propietario_tipo' => 'persona', 'propietario_nombre' => 'Marta Ruiz'],
            ['placa' => 'MOTO77', 'marca' => 'KTM', 'modelo' => 'Duke', 'tipo' => 'Moto', 'propietario_tipo' => 'persona', 'propietario_nombre' => 'Pedro Castillo'],
        ];

        foreach ($vehiculos as $vehiculo) {
            Vehiculo::create($vehiculo);
        }
    }
}
