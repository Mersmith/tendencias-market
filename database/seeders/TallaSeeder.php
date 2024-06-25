<?php

namespace Database\Seeders;

use App\Models\Talla;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TallaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tallas = ['2', '4', '6', '8', '10', '12', '14', '16', 'S', 'M', 'L', 'XL'];

        foreach ($tallas as $talla) {
            Talla::create([
                'nombre' => $talla
            ]);
        }
    }
}
