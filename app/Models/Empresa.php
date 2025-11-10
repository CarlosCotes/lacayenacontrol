<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
    'nombre', 
    'nit', 
    'direccion'
];

    public function usuarios()
    {
        return $this->hasMany(User::class, 'empresa_id');
    }
    public function vehiculos()
    {
        return $this->morphMany(Vehiculo::class, 'propietario');
    }
}
