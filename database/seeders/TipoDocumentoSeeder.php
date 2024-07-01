<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = ['Guia Entrada Directo', 'Transferencia Almacen', 'Guia Remisión', 'Nota Salida'];

        foreach ($tipos as $tipo) {
            TipoDocumento::create([
                'nombre' => $tipo
            ]);
        }
    }
}
