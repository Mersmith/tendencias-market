<?php

namespace Database\Seeders;

use App\Models\EnlacesRapidos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnlacesRapidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enlaces = [
            [
                'nombre' => 'Enlace 1',
                'enlaces' => json_encode([
                    [
                        'id' => 1,
                        'titulo' => 'Titulo 1',
                        'elementos' => [
                            ['nombre' => 'Nombre 1', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 2', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 3', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 4', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 5', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 6', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 7', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 8', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 9', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 10', 'link' => 'www.google.com'],
                        ],
                    ],
                    [
                        'id' => 2,
                        'titulo' => 'Titulo 2',
                        'elementos' => [
                            ['nombre' => 'Nombre 1', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 2', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 3', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 4', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 5', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 6', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 7', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 8', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 9', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 10', 'link' => 'www.google.com'],
                        ],
                    ],
                    [
                        'id' => 3,
                        'titulo' => 'Titulo 3',
                        'elementos' => [
                            ['nombre' => 'Nombre 1', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 2', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 3', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 4', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 5', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 6', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 7', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 8', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 9', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 10', 'link' => 'www.google.com'],
                        ],
                    ],
                    [
                        'id' => 4,
                        'titulo' => 'Titulo 4',
                        'elementos' => [
                            ['nombre' => 'Nombre 1', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 2', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 3', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 4', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 5', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 6', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 7', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 8', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 9', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 10', 'link' => 'www.google.com'],
                        ],
                    ],
                ]),
                'activo' => true
            ],
            [
                'nombre' => 'Enlace 2',
                'enlaces' => json_encode([
                    [
                        'id' => 1,
                        'titulo' => 'Titulo 1',
                        'elementos' => [
                            ['nombre' => 'Nombre 1', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 2', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 3', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 4', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 5', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 6', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 7', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 8', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 9', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 10', 'link' => 'www.google.com'],
                        ]
                    ],
                    [
                        'id' => 2,
                        'titulo' => 'Titulo 2',
                        'elementos' => [
                            ['nombre' => 'Nombre 1', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 2', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 3', 'link' => 'www.google.com'],
                        ]
                    ],
                    [
                        'id' => 3,
                        'titulo' => 'Titulo 3',
                        'elementos' => [
                            ['nombre' => 'Nombre 1', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 2', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 3', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 4', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 5', 'link' => 'www.google.com'],
                        ]
                    ],
                    [
                        'id' => 4,
                        'titulo' => 'Titulo 4',
                        'elementos' => [
                            ['nombre' => 'Nombre 1', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 2', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 3', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 4', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 5', 'link' => 'www.google.com'],
                            ['nombre' => 'Nombre 6', 'link' => 'www.google.com'],
                        ]
                    ],
                ]),
                'activo' => true
            ]
        ];

        foreach ($enlaces as $enlace) {
            EnlacesRapidos::create($enlace);
        }
    }
}
