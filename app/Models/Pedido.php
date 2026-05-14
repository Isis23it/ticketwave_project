<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id', 'estado', 'monto_total',
    ];

    protected $casts = [
        'monto_total' => 'decimal:2',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function items()
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function pago()
    {
        return $this->hasOne(Pago::class);
    }
}