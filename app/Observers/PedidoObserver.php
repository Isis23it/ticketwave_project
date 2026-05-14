<?php

namespace App\Observers;

use App\Models\Pedido;

class PedidoObserver
{
    /**
     * Cuando el estado cambia a "cancelado", se devuelven
     * los boletos — se incrementa disponibles por la cantidad
     * de cada item del pedido.
     */
    public function updating(Pedido $pedido): void
    {
        if ($pedido->isDirty('estado') && $pedido->estado === 'cancelado') {
            foreach ($pedido->items as $item) {
                $item->tipoEntrada->increment('disponibles', $item->cantidad);
            }
        }
    }
}