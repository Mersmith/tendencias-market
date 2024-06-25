<?php

namespace Database\Factories;

use App\Models\Marca;
use App\Models\Subcategoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $marca = Marca::all()->random();
        $subcategoria = Subcategoria::all()->random();

        $nombre = $this->faker->sentence(2);

        return [
            'marca_id' => $marca->id,
            'subcategoria_id' => $subcategoria->id,
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'descripcion' => $this->faker->text(),
            'variacion_talla' => $this->faker->randomElement([true, false]),
            'variacion_color' => $this->faker->randomElement([true, false]),
        ];
    }
}
