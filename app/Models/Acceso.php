<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vigilante_id',
        'hora_entrada',
        'hora_salida',
        'tipo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el vigilante que registra
    public function vigilante()
    {
        return $this->belongsTo(User::class, 'vigilante_id');
    }

}
