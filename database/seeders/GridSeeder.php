<?php

namespace Database\Seeders;

use App\Models\Grid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GridSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grids = [
            [
                'nombre' => 'Grid 1',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-50-1.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-1.jpg',
                        'link' => 'https://example.com/link1',
                        'width' => 50,
                    ],
                    [
                        'id' => 2,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-25-2.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-2.jpg',
                        'link' => 'https://example.com/link2',
                        'width' => 25,
                    ],
                    [
                        'id' => 3,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-25-3.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-3.jpg',
                        'link' => 'https://example.com/link3',
                        'width' => 25,
                    ],
                ]),
                'activo' => true
            ],
            [
                'nombre' => 'Grid 2',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-25-3.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-3.jpg',
                        'link' => 'https://example.com/link1',
                        'width' => 25,
                    ],
                    [
                        'id' => 2,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-25-2.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-2.jpg',
                        'link' => 'https://example.com/link2',
                        'width' => 25,
                    ],
                    [
                        'id' => 3,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-50-1.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-1.jpg',
                        'link' => 'https://example.com/link3',
                        'width' => 50,
                    ],
                    [
                        'id' => 4,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-50-1.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-1.jpg',
                        'link' => 'https://example.com/link1',
                        'width' => 50,
                    ],
                    [
                        'id' => 5,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-25-2.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-2.jpg',
                        'link' => 'https://example.com/link2',
                        'width' => 25,
                    ],
                    [
                        'id' => 6,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-25-3.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-3.jpg',
                        'link' => 'https://example.com/link3',
                        'width' => 25,
                    ]
                ]),
                'activo' => true
            ],
            [
                'nombre' => 'Grid 3',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-25-3.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-3.jpg',
                        'link' => 'https://example.com/link1',
                        'width' => 25,
                    ],
                    [
                        'id' => 2,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-25-2.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-2.jpg',
                        'link' => 'https://example.com/link2',
                        'width' => 25,
                    ],
                    [
                        'id' => 3,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-50-1.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-1.jpg',
                        'link' => 'https://example.com/link3',
                        'width' => 50,
                    ],
                    [
                        'id' => 4,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-50-1.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-1.jpg',
                        'link' => 'https://example.com/link1',
                        'width' => 50,
                    ],
                    [
                        'id' => 5,
                        'imagenComputadora' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-computadora-50-1.jpg',
                        'imagenMovil' => 'http://127.0.0.1:8000/assets/imagenes/grid/grid-movil-1.jpg',
                        'link' => 'https://example.com/link3',
                        'width' => 50,
                    ]
                ]),
                'activo' => true
            ]
        ];

        foreach ($grids as $grid) {
            Grid::create($grid);
        }
    }
}
