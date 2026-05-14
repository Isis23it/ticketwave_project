<?php

namespace App\Services;

use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\Pago;
use App\Models\TipoEntrada;
use Illuminate\Support\Facades\DB;
use Exception;

class CompraService
{
    /**
     * Procesa la compra de boletos de forma atómica.
     * Usa DB::transaction() con lockForUpdate para evitar
     * condiciones de carrera cuando dos usuarios compran
     * el último boleto simultáneamente.
     */
    public function procesarCompra(int $usuarioId, array $items, string $metodoPago): Pedido
    {
        return DB::transaction(function () use ($usuarioId, $items, $metodoPago) {

            $montoTotal = 0;
            $itemsValidados = [];

            foreach ($items as $item) {
                // lockForUpdate — bloqueo pesimista para evitar
                // que dos usuarios compren el mismo boleto al mismo tiempo
                $tipoEntrada = TipoEntrada::lockForUpdate()
                    ->findOrFail($item['tipo_entrada_id']);

                $disponibles = $tipoEntrada->disponibles - ($tipoEntrada->vendidas ?? 0);

                // si no hay suficientes boletos disponibles, lanza excepción
                // y revierte toda la transacción automáticamente
                if ($disponibles < $item['cantidad']) {
                    throw new Exception("Sin disponibilidad para: {$tipoEntrada->nombre}");
                }

                $subtotal = $tipoEntrada->precio * $item['cantidad'];
                $montoTotal += $subtotal;

                $itemsValidados[] = [
                    'tipo_entrada' => $tipoEntrada,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $tipoEntrada->precio,
                ];
            }

            // crear el pedido
            $pedido = Pedido::create([
                'usuario_id' => $usuarioId,
                'estado' => 'confirmado',
                'monto_total' => $montoTotal,
            ]);

            foreach ($itemsValidados as $item) {
                // crear cada item del pedido
                ItemPedido::create([
                    'pedido_id' => $pedido->id,
                    'tipo_entrada_id' => $item['tipo_entrada']->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                ]);

                // incrementar vendidas — se hace aquí dentro de la transacción
                // para que el rollback también revierta este cambio si algo falla
                $item['tipo_entrada']->increment('vendidas', $item['cantidad']);
            }

            // crear el pago asociado al pedido
            Pago::create([
                'pedido_id' => $pedido->id,
                'metodo_pago' => $metodoPago,
                'estado' => 'completado',
                'monto' => $montoTotal,
                'id_transaccion' => uniqid('TXN-', true),
                'pagado_en' => now(),
            ]);

            return $pedido;
        });
    }
}