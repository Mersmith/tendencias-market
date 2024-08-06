<?php

namespace Database\Seeders;

use App\Models\Vitrina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VitrinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vitrinas = [
            [
                'nombre' => 'Vitrina',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'imagen_computadora' => 'http://127.0.0.1:8000/assets/imagenes/vitrina/vitrina-tipo-1-computadora-1.jpg',
                        'imagen_movil' => 'http://127.0.0.1:8000/assets/imagenes/vitrina/vitrina-tipo-1-movil-1.jpg',
                        'link' => 'https://example.com/link1',
                    ],
                    [
                        'id' => 2,
                        'imagen_computadora' => 'http://127.0.0.1:8000/assets/imagenes/vitrina/vitrina-tipo-1-computadora-2.jpg',
                        'imagen_movil' => 'http://127.0.0.1:8000/assets/imagenes/vitrina/vitrina-tipo-1-movil-2.jpg',
                        'link' => 'https://example.com/link2',
                    ],
                    [
                        'id' => 3,
                        'imagen_computadora' => 'http://127.0.0.1:8000/assets/imagenes/vitrina/vitrina-tipo-1-computadora-3.jpg',
                        'imagen_movil' => 'http://127.0.0.1:8000/assets/imagenes/vitrina/vitrina-tipo-1-movil-3.jpg',
                        'link' => 'https://example.com/link3',
                    ],
                    [
                        'id' => 4,
                        'imagen_computadora' => 'http://127.0.0.1:8000/assets/imagenes/vitrina/vitrina-tipo-1-computadora-4.jpg',
                        'imagen_movil' => 'http://127.0.0.1:8000/assets/imagenes/vitrina/vitrina-tipo-1-movil-4.jpg',
                        'link' => 'https://example.com/link3',
                    ],
                ]),
                'activo' => true
            ]
        ];

        foreach ($vitrinas as $vitrina) {
            Vitrina::create($vitrina);
        }
    }
}
