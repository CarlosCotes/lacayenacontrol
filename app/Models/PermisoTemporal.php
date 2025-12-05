<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisoTemporal extends Model
{
    protected $table = 'permisos_temporales';
    
    protected $fillable = [
        'funcionario_id',
        'nombre_visitante',
        'documento_visitante',
        'fecha_ingreso',
        'fecha_salida',
        'motivo',
        'estado',
        'supervisor_id',
    ];
    public function funcionario()
{
    return $this->belongsTo(User::class, 'funcionario_id');
}

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
