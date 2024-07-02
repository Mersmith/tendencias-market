<?php

namespace Database\Factories;

use App\Models\Sede;
use App\Models\TipoDocumento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Serie>
 */
class SerieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sede_id' => Sede::inRandomOrder()->first()->id,
            'tipo_documento_id' => TipoDocumento::inRandomOrder()->first()->id,
            //'correlativo' => $this->faker->numberBetween(1, 1000),
            'correlativo' => 0,
            'descripcion' => $this->faker->sentence(),
            //'activo' => $this->faker->boolean(),
            'activo' => true,
        ];
    }
}
