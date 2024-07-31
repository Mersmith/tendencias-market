<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImagenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'imagen1.jpg',
            'imagen2.jpg',
            'imagen3.jpg',
        ];

        foreach ($images as $image) {
            // Check if the image exists in the specified path
            if (Storage::disk('public')->exists("images/{$image}")) {
                // Store the image in the database
                DB::table('imagens')->insert([
                    'path' => "images/{$image}",
                    'url' => Storage::url("images/{$image}"),
                    'titulo' => pathinfo($image, PATHINFO_FILENAME),
                    'descripcion' => "Descripción de {$image}",
                    'extension' => pathinfo($image, PATHINFO_EXTENSION),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
