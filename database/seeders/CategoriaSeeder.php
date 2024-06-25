<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Electrohogar',
                'slug' => Str::slug('Electrohogar'),
            ],
            [
                'nombre' => 'Tecnología',
                'slug' => Str::slug('Tecnología'),
            ],
            [
                'nombre' => 'Mujer',
                'slug' => Str::slug('Mujer'),
            ],
            [
                'nombre' => 'Hombre',
                'slug' => Str::slug('Hombre'),
            ],
            [
                'nombre' => 'Accesorios Moda',
                'slug' => Str::slug('Accesorios Moda'),
            ],
            [
                'nombre' => 'Muebles y Organización',
                'slug' => Str::slug('Muebles y Organización'),
            ],
            [
                'nombre' => 'Dormitorio',
                'slug' => Str::slug('Dormitorio'),
            ],
            [
                'nombre' => 'Niños y juguetes',
                'slug' => Str::slug('Niños y juguetes'),
            ],
            [
                'nombre' => 'Zapatos',
                'slug' => Str::slug('Zapatos'),
            ],
            [
                'nombre' => 'Deportes y aire libre',
                'slug' => Str::slug('Deportes y aire libre'),
            ],
            [
                'nombre' => 'Belleza y salud',
                'slug' => Str::slug('Belleza y salud'),
            ],
            [
                'nombre' => 'Cocina y menaje',
                'slug' => Str::slug('Cocina y menaje'),
            ],
            [
                'nombre' => 'Baño',
                'slug' => Str::slug('Baño'),
            ],
            [
                'nombre' => 'Supermercado',
                'slug' => Str::slug('Supermercado'),
            ],
            [
                'nombre' => 'Bebés',
                'slug' => Str::slug('Bebés'),
            ],
            [
                'nombre' => 'Jardín y terraza',
                'slug' => Str::slug('Jardín y terraza'),
            ],
            [
                'nombre' => 'Decoración e iluminación',
                'slug' => Str::slug('Decoración e iluminación'),
            ],
            [
                'nombre' => 'Mascotas',
                'slug' => Str::slug('Mascotas'),
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::factory(1)->create($categoria);
        }
    }
}
