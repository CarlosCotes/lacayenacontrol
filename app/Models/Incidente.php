<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    use HasFactory;

    protected $fillable = [
        'vigilante_id',
        'user_id',
        'tipo',
        'descripcion',
        'estado',
    ];

    // Relación con el vigilante que reporta
    public function vigilante()
    {
        return $this->belongsTo(User::class, 'vigilante_id');
    }

    // Relación opcional con el usuario relacionado (si aplica)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
