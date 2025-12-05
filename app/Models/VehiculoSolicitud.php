<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiculoSolicitud extends Model
{
    protected $table = 'vehiculo_solicitudes';

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'tipo',
        'motivo',
        'estado',
        'funcionario_id',
        'user_id',
        'razon_rechazo'
    ];

    public function funcionario()
    {
        return $this->belongsTo(User::class, 'funcionario_id');
    }
    
    public function empleado()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
