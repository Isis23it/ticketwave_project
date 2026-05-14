<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    use HasFactory;

    protected $table = 'items_pedido';

    protected $fillable = [
        'pedido_id', 'tipo_entrada_id', 'cantidad', 'precio_unitario',
    ];

    protected $casts = [
        'precio_unitario' => 'decimal:2',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function tipoEntrada()
    {
        return $this->belongsTo(TipoEntrada::class);
    }
}