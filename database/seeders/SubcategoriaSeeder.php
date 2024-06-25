<?php

namespace Database\Seeders;

use App\Models\Subcategoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategorias = [
            /* Electrohogar */
            [
                'categoria_id' => 1,
                'nombre' => 'Refrigeradora',
                'slug' => Str::slug('Refrigeradora'),
            ],
            [
                'categoria_id' => 1,
                'nombre' => 'Cocina',
                'slug' => Str::slug('Cocina'),
            ],
            [
                'categoria_id' => 1,
                'nombre' => 'Lavado',
                'slug' => Str::slug('Lavado'),
            ],
            [
                'categoria_id' => 1,
                'nombre' => 'Planchado',
                'slug' => Str::slug('Planchado'),
            ],

            /* Tecnología */
            [
                'categoria_id' => 2,
                'nombre' => 'Celulares',
                'slug' => Str::slug('Celulares'),
            ],
            [
                'categoria_id' => 2,
                'nombre' => 'Computo',
                'slug' => Str::slug('Computo'),
            ],
            [
                'categoria_id' => 2,
                'nombre' => 'Cámaras y Drones',
                'slug' => Str::slug('Cámaras y Drones'),
            ],
            [
                'categoria_id' => 2,
                'nombre' => 'Smarthphone y Domótica',
                'slug' => Str::slug('Smarthphone y Domótica'),
            ],
            [
                'categoria_id' => 2,
                'nombre' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],

            /* Mujer */
            [
                'categoria_id' => 3,
                'nombre' => 'Ropa Mujer',
                'slug' => Str::slug('Ropa Mujer'),
            ],

            /* Hombre */
            [
                'categoria_id' => 4,
                'nombre' => 'Ropa Hombre',
                'slug' => Str::slug('Ropa Hombre'),
            ],
            [
                'categoria_id' => 4,
                'nombre' => 'Zapatos',
                'slug' => Str::slug('Zapatos'),
            ],
            [
                'categoria_id' => 4,
                'nombre' => 'Accesorios',
                'slug' => Str::slug('Accesorios'),
            ],
        ];

        foreach ($subcategorias as $subcategoria) {
            Subcategoria::factory(1)->create($subcategoria);
        }
    }
}
