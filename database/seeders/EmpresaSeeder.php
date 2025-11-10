<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    public function run(): void
    {
        $empresas = [
            [
                'nombre' => 'La Cayena',
                'nit' => '900100100-1',
                'direccion' => 'Calle 10 #25-45, Barranquilla',
            ],
            [
                'nombre' => 'Torres S.A.S.',
                'nit' => '900200200-2',
                'direccion' => 'Carrera 21 #12-34, Medellín',
            ],
            [
                'nombre' => 'Servicios del Caribe LTDA',
                'nit' => '900300300-3',
                'direccion' => 'Avenida 7 #65-20, Cartagena',
            ],
            [
                'nombre' => 'Innovatech Solutions',
                'nit' => '900400400-4',
                'direccion' => 'Calle 80 #45-22, Bogotá',
            ],
        ];

        foreach ($empresas as $empresa) {
            Empresa::updateOrCreate(['nombre' => $empresa['nombre']], $empresa);
        }
    }
}
