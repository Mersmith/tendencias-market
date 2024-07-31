<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Imagen;
class ImagenablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = Producto::all();
        $imagenes = Imagen::all();

        foreach ($productos as $producto) {
            // Asignar aleatoriamente entre 1 y 3 imágenes a cada producto
            $imagenesAsignadas = $imagenes->random(rand(1, 3));

            foreach ($imagenesAsignadas as $imagen) {
                DB::table('imagenables')->insert([
                    'imagen_id' => $imagen->id,
                    'imagenable_id' => $producto->id,
                    'imagenable_type' => Producto::class,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
