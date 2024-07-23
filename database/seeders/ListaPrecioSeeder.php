<?php

namespace Database\Seeders;

use App\Models\ListaPrecio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListaPrecioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lista_precios = ['Mayorista', 'Horizontal', 'Etiqueta'];

        foreach ($lista_precios as $l_p) {
            ListaPrecio::create([
                'nombre' => $l_p
            ]);
        }
    }
}
