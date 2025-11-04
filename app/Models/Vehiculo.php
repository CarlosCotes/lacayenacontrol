<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = [
        'placa', 'marca', 'modelo', 'tipo', 'propietario_tipo', 'propietario_nombre'
    ];

    public function accesos()
    {
        return $this->hasMany(VehiculoAcceso::class);
    }
}
