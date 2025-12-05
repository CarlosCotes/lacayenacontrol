<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Acceso extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'permiso_id',
        'vigilante_id',
        'hora_entrada',
        'hora_salida',
        'tipo',
        'origen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function permisoTemporal()
    {
        return $this->belongsTo(PermisoTemporal::class, 'permiso_id');
    }

    public function vigilante()
    {
        return $this->belongsTo(User::class, 'vigilante_id');
    }
}
