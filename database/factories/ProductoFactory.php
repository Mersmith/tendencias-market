<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Marca;
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
        //$categoria = Categoria::all()->random();
        $categoriaIds = [1, 2, 3, 4, 5];
        $categoriaId = $categoriaIds[array_rand($categoriaIds)];

        $nombre = $this->faker->sentence(2);

        return [
            'marca_id' => $marca->id,
            'categoria_id' => $categoriaId,
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'descripcion' => $this->faker->text(),
            'variacion_talla' => $this->faker->randomElement([true, false]),
            'variacion_color' => $this->faker->randomElement([true, false]),
        ];
    }
}
