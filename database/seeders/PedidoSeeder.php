<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\ItemPedido;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $pedidos = [
            ['usuario_id' => 3, 'estado' => 'confirmado', 'monto_total' => 1600.00, 'items' => [['tipo_entrada_id' => 1, 'cantidad' => 2, 'precio_unitario' => 800.00]]],
            ['usuario_id' => 4, 'estado' => 'confirmado', 'monto_total' => 2500.00, 'items' => [['tipo_entrada_id' => 2, 'cantidad' => 1, 'precio_unitario' => 2500.00]]],
            ['usuario_id' => 5, 'estado' => 'confirmado', 'monto_total' => 700.00, 'items' => [['tipo_entrada_id' => 3, 'cantidad' => 2, 'precio_unitario' => 350.00]]],
            ['usuario_id' => 6, 'estado' => 'pendiente', 'monto_total' => 650.00, 'items' => [['tipo_entrada_id' => 4, 'cantidad' => 1, 'precio_unitario' => 650.00]]],
            ['usuario_id' => 7, 'estado' => 'confirmado', 'monto_total' => 2400.00, 'items' => [['tipo_entrada_id' => 5, 'cantidad' => 2, 'precio_unitario' => 1200.00]]],
            ['usuario_id' => 3, 'estado' => 'cancelado', 'monto_total' => 800.00, 'items' => [['tipo_entrada_id' => 6, 'cantidad' => 1, 'precio_unitario' => 800.00]]],
            ['usuario_id' => 4, 'estado' => 'confirmado', 'monto_total' => 1200.00, 'items' => [['tipo_entrada_id' => 7, 'cantidad' => 2, 'precio_unitario' => 600.00]]],
            ['usuario_id' => 5, 'estado' => 'pendiente', 'monto_total' => 1800.00, 'items' => [['tipo_entrada_id' => 8, 'cantidad' => 1, 'precio_unitario' => 1800.00]]],
            ['usuario_id' => 6, 'estado' => 'confirmado', 'monto_total' => 1000.00, 'items' => [['tipo_entrada_id' => 9, 'cantidad' => 2, 'precio_unitario' => 500.00]]],
            ['usuario_id' => 7, 'estado' => 'confirmado', 'monto_total' => 1500.00, 'items' => [['tipo_entrada_id' => 10, 'cantidad' => 1, 'precio_unitario' => 1500.00]]],
        ];

        foreach ($pedidos as $pedidoData) {
            $items = $pedidoData['items'];
            unset($pedidoData['items']);

            $pedido = Pedido::create($pedidoData);

            foreach ($items as $item) {
                ItemPedido::create([
                    'pedido_id' => $pedido->id,
                    'tipo_entrada_id' => $item['tipo_entrada_id'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                ]);
            }
        }
    }
}