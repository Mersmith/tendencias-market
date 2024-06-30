<?php

namespace Database\Factories;

use App\Models\GuiaEntradaDirecto;
use App\Models\Variacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuiaEntradaDirectoDetalle>
 */
class GuiaEntradaDirectoDetalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'guia_entrada_directo_id' => GuiaEntradaDirecto::inRandomOrder()->first()->id,
            'variacion_id' => Variacion::inRandomOrder()->first()->id,
            'stock' => $this->faker->numberBetween(5, 100),
            'stock_minimo' => $this->faker->numberBetween(1, 10),
        ];
    }
}
