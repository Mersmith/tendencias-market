<?php

namespace Database\Seeders;

use App\Models\ListaPrecio;
use App\Models\Variacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class VariacionListaPreciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variaciones = Variacion::all();
        $listaPrecios = ListaPrecio::all();

        foreach ($variaciones as $variacion) {
            foreach ($listaPrecios as $listaPrecio) {
                DB::table('variacion_lista_precios')->insert([
                    'variacion_id' => $variacion->id,
                    'lista_precio_id' => $listaPrecio->id,
                    'precio' => rand(100, 200),
                    'precio_antiguo' => rand(300, 500),
                ]);
            }
        }
    }
}
