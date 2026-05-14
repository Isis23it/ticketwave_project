<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id', 'recinto_id', 'nombre', 'descripcion',
        'categoria', 'imagen_url', 'estado', 'fecha_evento',
    ];

    protected $casts = [
        'fecha_evento' => 'datetime',
    ];

    public function recinto()
    {
        return $this->belongsTo(Recinto::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function tiposEntrada()
    {
        return $this->hasMany(TipoEntrada::class);
    }
}