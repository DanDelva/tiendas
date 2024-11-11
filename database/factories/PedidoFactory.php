<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'isbn' => $this->faker->isbn13,
            'title' => $this->faker->sentence(3),
            'Fecha_Pedido' =>$this->faker->date(),
            'Fecha_Envio' =>$this->faker->date(),
            'Metodo_Pago' =>$this->faker->randomElement(['tarjeta de crédito', 'paypal', 'transferencia bancaria']),
            'description' =>$this->faker->text(100),
            'total' =>$this->faker->randomFloat(2, 10, 1000),
            'image' =>'/img/example.png'
        ];
    }
}
