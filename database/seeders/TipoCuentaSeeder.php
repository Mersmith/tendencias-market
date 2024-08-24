<?php

namespace Database\Seeders;

use App\Models\TipoCuenta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoCuenta::factory()->count(3)->create();
    }
}
