<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiculoAcceso extends Model
{
    protected $fillable = [
        'vehiculo_id', 'vigilante_id', 'tipo', 'hora_entrada', 'hora_salida'
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function vigilante()
    {
        return $this->belongsTo(User::class, 'vigilante_id');
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
        
}