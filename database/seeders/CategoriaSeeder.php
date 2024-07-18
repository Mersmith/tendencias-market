<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Crear categorías padre
        for ($i = 1; $i <= 2; $i++) {
            $nombrePadre = $faker->word . ' ' . $faker->word;
            $padre = Categoria::create([
                'nombre' => $nombrePadre,
                'slug' => Str::slug($nombrePadre),
                'codigo' => 'CAT' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'descripcion' => $faker->sentence,
                'activo' => true,
                'orden' => $i,
            ]);

            // Crear categorías hijas
            for ($j = 1; $j <= 2; $j++) {
                $nombreHijo = $faker->word . ' ' . $faker->word;
                $hijo = Categoria::create([
                    'nombre' => $nombreHijo,
                    'slug' => Str::slug($nombreHijo),
                    'codigo' => 'CAT' . str_pad($i * 10 + $j, 5, '0', STR_PAD_LEFT),
                    'descripcion' => $faker->sentence,
                    'activo' => true,
                    'categoria_padre_id' => $padre->id,
                    'orden' => $j,
                ]);

                // Crear subcategorías
                for ($k = 1; $k <= 2; $k++) {
                    $nombreSubcategoria = $faker->word . ' ' . $faker->word;
                    Categoria::create([
                        'nombre' => $nombreSubcategoria,
                        'slug' => Str::slug($nombreSubcategoria),
                        'codigo' => 'CAT' . str_pad($i * 100 + $j * 10 + $k, 5, '0', STR_PAD_LEFT),
                        'descripcion' => $faker->sentence,
                        'activo' => true,
                        'categoria_padre_id' => $hijo->id,
                        'orden' => $k,
                    ]);
                }
            }
        }
    }
}
