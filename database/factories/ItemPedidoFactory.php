<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\TipoEntrada;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemPedidoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pedido_id' => Pedido::factory(),
            'tipo_entrada_id' => TipoEntrada::factory(),
            'cantidad' => $this->faker->numberBetween(1, 6),
            // se guarda el precio al momento de la compra
            'precio_unitario' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}