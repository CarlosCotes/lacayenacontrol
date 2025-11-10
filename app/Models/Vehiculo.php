<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = [
        'placa', 'marca', 'modelo', 'tipo', 'user_id', 'empresa_id'
    ];

    public function accesos()
    {
        return $this->hasMany(VehiculoAcceso::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
