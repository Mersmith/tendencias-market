<?php

namespace Database\Seeders;

use App\Models\ListaPrecio;
use App\Models\Producto;
use App\Models\Variacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductoListaPreciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = Producto::all();
        $listaPrecios = ListaPrecio::all();

        foreach ($productos as $producto) {
            foreach ($listaPrecios as $listaPrecio) {
                DB::table('producto_lista_precios')->insert([
                    'producto_id' => $producto->id,
                    'lista_precio_id' => $listaPrecio->id,
                    'precio' => rand(100, 200),
                    'precio_antiguo' => rand(300, 500),
                ]);
            }
        }
    }
}
