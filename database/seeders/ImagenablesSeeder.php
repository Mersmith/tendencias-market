<?php

namespace Database\Seeders;

use App\Models\Categoria;
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
        $categorias = Categoria::all();
        $imagenes = Imagen::all();

        //PRODUCTOS
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

        //CATEGORIAS
        foreach ($categorias as $categoria) {
            // Asignar aleatoriamente una imagen a cada categoría
            $imagenAsignada = $imagenes->random();

            if ($imagenAsignada) {
                DB::table('imagenables')->insert([
                    'imagen_id' => $imagenAsignada->id,
                    'imagenable_id' => $categoria->id,
                    'imagenable_type' => Categoria::class,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
