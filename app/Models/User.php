<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'documento',
        'email',
        'password',
        'role_id',
        'empresa_id',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    public function scopeInactivos($query)
    {
        return $query->where('estado', 'inactivo');
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    public function accesos()
    {
        return $this->hasMany(Acceso::class);
    }
    // Usuarios que reportaron incidentes (vigilantes)
    public function incidentesReportados()
    {
        return $this->hasMany(Incidente::class, 'vigilante_id');
    }

    // Incidentes relacionados con este usuario
    public function incidentesRelacionados()
    {
        return $this->hasMany(Incidente::class, 'user_id');
    }
}
