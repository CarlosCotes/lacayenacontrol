<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudEmpleado extends Model
{
    protected $table = 'solicitudes_empleados';

    protected $fillable = [
        'funcionario_id',
        'empresa_id',
        'nombre_empleado',
        'email',
        'documento',
        'cargo',
        'motivo',
        'estado',
        'supervisor_id',
        'fecha_aprobacion',
        'motivo_rechazo',
    ];

    // Funcionario que creó la solicitud
    public function funcionario()
    {
        return $this->belongsTo(User::class, 'funcionario_id');
    }

    // Supervisor que la aprueba o rechaza
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    // Empresa a la que pertenece
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
