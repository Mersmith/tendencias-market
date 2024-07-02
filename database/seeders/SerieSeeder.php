<?php

namespace Database\Seeders;

use App\Models\Serie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres_series = ['F00001', 'F00002', 'GED0001'];

        foreach ($nombres_series as $nombre) {
            Serie::factory(1)->create([
                'nombre' => $nombre,
            ]);
        }
    }
}
