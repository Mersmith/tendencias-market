<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaMarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las categorías y marcas
        $categorias = Categoria::all();
        $marcas = Marca::all();

        // Asignar marcas aleatorias a cada categoría
        foreach ($categorias as $categoria) {
            // Seleccionar un número aleatorio de marcas para asignar a la categoría
            $numeroDeMarcas = rand(1, 3); // Puedes ajustar el rango según sea necesario
            $marcasAleatorias = $marcas->random($numeroDeMarcas);

            // Asignar las marcas a la categoría
            $categoria->marcas()->attach($marcasAleatorias);
        }
    }
}
