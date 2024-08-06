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
            [
                'imagen_276' => 'http://127.0.0.1:8000/assets/imagenes/producto/producto-tipo-1-1.jpg',
            ],
            [
                'imagen_276' => 'http://127.0.0.1:8000/assets/imagenes/producto/producto-tipo-1-2.jpg',
            ],
            [
                'imagen_276' => 'http://127.0.0.1:8000/assets/imagenes/producto/producto-tipo-1-3.jpg',
            ],
            [
                'imagen_276' => 'http://127.0.0.1:8000/assets/imagenes/producto/producto-tipo-1-4.jpg',
            ],
            [
                'imagen_276' => 'http://127.0.0.1:8000/assets/imagenes/producto/producto-tipo-1-5.jpg',
            ],
            [
                'imagen_276' => 'http://127.0.0.1:8000/assets/imagenes/producto/producto-tipo-1-6.jpg',
            ],
            [
                'imagen_276' => 'http://127.0.0.1:8000/assets/imagenes/producto/producto-tipo-1-7.jpg',
            ],
            [
                'imagen_276' => 'http://127.0.0.1:8000/assets/imagenes/producto/producto-tipo-1-8.jpg',
            ]
        ];

        // Delete all files in the 'images' directory
        Storage::disk('public')->deleteDirectory('images');
        Storage::disk('public')->makeDirectory('images');

        foreach ($images as $image) {
            $url = $image['imagen_276'];
            $fileName = basename($url);

            // Define the source path of the images
            $sourcePath = public_path("assets/imagenes/producto/{$fileName}");

            // Check if the image exists in the source path
            if (file_exists($sourcePath)) {
                // Store the image in the public storage disk
                $storedPath = Storage::disk('public')->putFile('images', new \Illuminate\Http\File($sourcePath));

                // Insert the image data into the database
                DB::table('imagens')->insert([
                    'path' => $storedPath,
                    'url' => Storage::url($storedPath),
                    'titulo' => pathinfo($fileName, PATHINFO_FILENAME),
                    'descripcion' => "Descripción de {$fileName}",
                    'extension' => pathinfo($fileName, PATHINFO_EXTENSION),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
