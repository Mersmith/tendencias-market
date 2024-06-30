<?php

namespace Database\Factories;

use App\Models\Almacen;
use App\Models\Sede;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuiaEntradaDirecto>
 */
class GuiaEntradaDirectoFactory extends Factory
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
            'almacen_id' => Almacen::inRandomOrder()->first()->id,
            //'estado' => $this->faker->randomElement(['Aprobado', 'Rechazado', 'Observado', 'Eliminado']),
            'estado' => 'Aprobado',
            'observacion' => $this->faker->sentence,
            'descripcion' => $this->faker->sentence,
            'fecha_entrada' => $this->faker->date,
        ];
    }
}
