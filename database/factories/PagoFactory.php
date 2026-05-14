<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pedido_id' => Pedido::factory(),
            'metodo_pago' => $this->faker->randomElement(['tarjeta', 'paypal', 'transferencia']),
            'estado' => $this->faker->randomElement(['pendiente', 'completado', 'fallido', 'reembolsado']),
            'monto' => $this->faker->randomFloat(2, 100, 10000),
            // id externo del procesador de pagos
            'id_transaccion' => $this->faker->uuid(),
            'pagado_en' => $this->faker->dateTimeThisYear(),
        ];
    }
}