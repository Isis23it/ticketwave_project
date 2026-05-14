<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recinto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'ciudad', 'estado', 'colonia', 'pais',
        'codigo_postal', 'direccion', 'capacidad',
        'latitud', 'longitud', 'imagen_url', 'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'latitud' => 'decimal:7',
        'longitud' => 'decimal:7',
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}