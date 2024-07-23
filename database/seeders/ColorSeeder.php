<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colores = [
            ['nombre' => 'Blanco', 'codigo_color' => '#FFFFFF'],
            ['nombre' => 'Negro', 'codigo_color' => '#000000'],
            ['nombre' => 'Azul', 'codigo_color' => '#0000FF'],
            ['nombre' => 'Morado', 'codigo_color' => '#800080'],
            //['nombre' => 'Marrón', 'codigo_color' => '#A52A2A'],
            //['nombre' => 'Canela', 'codigo_color' => '#D2691E'],
            //['nombre' => 'Anaranjado', 'codigo_color' => '#FFA500'],
            //['nombre' => 'Amarillo', 'codigo_color' => '#FFFF00'],
            //['nombre' => 'Celeste', 'codigo_color' => '#87CEEB'],
            //['nombre' => 'Gris', 'codigo_color' => '#808080'],
            //['nombre' => 'Rosado', 'codigo_color' => '#FFC0CB'],
        ];

        foreach ($colores as $color) {
            Color::create([
                'nombre' => $color['nombre'],
                'codigo_color' => $color['codigo_color'],
                'activo' => 1,
            ]);
        }
    }
}
