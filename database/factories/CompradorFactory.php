<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comprador>
 */
class CompradorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellido_paterno' => $this->faker->lastName,
            'apellido_materno' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'dni' => $this->faker->unique()->numerify('########'), // Genera un DNI ficticio de 8 dígitos
            'celular' => $this->faker->phoneNumber,
            'puntos' => $this->faker->numberBetween(0, 1000),  // Puedes ajustar el rango según tu lógica de negocio
        ];
    }
}
