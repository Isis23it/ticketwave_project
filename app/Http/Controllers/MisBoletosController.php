<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Support\Carbon;

class MisBoletosController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with([
                'items.tipoEntrada.evento.recinto',
                'pago',
            ])
            ->where('usuario_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        $boletosActivos = $pedidos
            ->where('estado', '!=', 'cancelled')
            ->sum(fn ($pedido) => $pedido->items->sum('cantidad'));

        $totalGastado = $pedidos
            ->where('estado', '!=', 'cancelled')
            ->sum('monto_total');

        return view('mis-boletos', compact(
            'pedidos',
            'boletosActivos',
            'totalGastado'
        ));
    }
}