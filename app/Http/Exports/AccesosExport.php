<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AccesosExport implements FromCollection, WithHeadings
{
    protected $accesos;

    public function __construct($accesos)
    {
        $this->accesos = $accesos;
    }

    public function collection()
    {
        return $this->accesos->map(function($acceso){
            return [
                'Usuario' => $acceso->user->name,
                'Documento' => $acceso->user->documento,
                'Hora Entrada' => $acceso->hora_entrada,
                'Hora Salida' => $acceso->hora_salida ?? '---',
                'Registrado por' => $acceso->vigilante->name ?? '---'
            ];
        });
    }

    public function headings(): array
    {
        return ['Usuario', 'Documento', 'Hora Entrada', 'Hora Salida', 'Registrado por'];
    }
}
