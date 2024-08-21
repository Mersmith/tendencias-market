<?php

namespace Database\Seeders;

use App\Models\Mostrador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MostradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mostradores = [
            [
                'nombre' => 'Mostrador 1',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'titulo' => 'Categoria 1',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-1.jpg',
                        'link' => 'https://example.com/link1'
                    ],
                    [
                        'id' => 2,
                        'titulo' => 'Categoria 2',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-2.jpg',
                        'link' => 'https://example.com/link2'
                    ],
                    [
                        'id' => 3,
                        'titulo' => 'Categoria 3',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-3.jpg',
                        'link' => 'https://example.com/link3'
                    ],
                    [
                        'id' => 4,
                        'titulo' => 'Categoria 4',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-4.jpg',
                        'link' => 'https://example.com/link4'
                    ],
                    [
                        'id' => 5,
                        'titulo' => 'Categoria 5',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-5.jpg',
                        'link' => 'https://example.com/link5'
                    ],
                    [
                        'id' => 6,
                        'titulo' => 'Categoria 6',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-6.jpg',
                        'link' => 'https://example.com/link6'
                    ],
                    [
                        'id' => 7,
                        'titulo' => 'Categoria 7',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-7.jpg',
                        'link' => 'https://example.com/link7'
                    ],
                    [
                        'id' => 8,
                        'titulo' => 'Categoria 8',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-8.jpg',
                        'link' => 'https://example.com/link8'
                    ],
                    [
                        'id' => 9,
                        'titulo' => 'Categoria 9',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-9.jpg',
                        'link' => 'https://example.com/link9'
                    ],
                    [
                        'id' => 10,
                        'titulo' => 'Categoria 10',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-10.jpg',
                        'link' => 'https://example.com/link10'
                    ],
                    [
                        'id' => 11,
                        'titulo' => 'Categoria 11',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-11.jpg',
                        'link' => 'https://example.com/link11'
                    ],
                    [
                        'id' => 12,
                        'titulo' => 'Categoria 12',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-12.jpg',
                        'link' => 'https://example.com/link12'
                    ]
                ]),
                'activo' => true
            ],
            [
                'nombre' => 'Mostrador 2',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-1.jpg',
                        'link' => 'https://example.com/link1'
                    ],
                    [
                        'id' => 2,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-2.jpg',
                        'link' => 'https://example.com/link2'
                    ],
                    [
                        'id' => 3,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-3.jpg',
                        'link' => 'https://example.com/link3'
                    ],
                    [
                        'id' => 4,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-4.jpg',
                        'link' => 'https://example.com/link4'
                    ],
                    [
                        'id' => 5,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-5.jpg',
                        'link' => 'https://example.com/link5'
                    ],
                    [
                        'id' => 6,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-6.jpg',
                        'link' => 'https://example.com/link6'
                    ],
                    [
                        'id' => 7,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-7.jpg',
                        'link' => 'https://example.com/link7'
                    ],
                    [
                        'id' => 8,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-8.jpg',
                        'link' => 'https://example.com/link8'
                    ],
                    [
                        'id' => 9,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-9.jpg',
                        'link' => 'https://example.com/link9'
                    ],
                    [
                        'id' => 10,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-10.jpg',
                        'link' => 'https://example.com/link10'
                    ],
                    [
                        'id' => 11,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-11.jpg',
                        'link' => 'https://example.com/link11'
                    ],
                    [
                        'id' => 12,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-12.jpg',
                        'link' => 'https://example.com/link12'
                    ]
                ]),
                'activo' => true
            ],
            [
                'nombre' => 'Mostrador 3',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'titulo' => 'Beneficio 1',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-1.jpg',
                        'link' => 'https://example.com/link1'
                    ],
                    [
                        'id' => 2,
                        'titulo' => 'Beneficio 2',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-2.jpg',
                        'link' => 'https://example.com/link2'
                    ],
                    [
                        'id' => 3,
                        'titulo' => 'Beneficio 3',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-3.jpg',
                        'link' => 'https://example.com/link3'
                    ],
                    [
                        'id' => 4,
                        'titulo' => 'Beneficio 4',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-4.jpg',
                        'link' => 'https://example.com/link4'
                    ],
                    [
                        'id' => 5,
                        'titulo' => 'Beneficio 5',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-5.jpg',
                        'link' => 'https://example.com/link5'
                    ],
                    [
                        'id' => 6,
                        'titulo' => 'Beneficio 6',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-6.jpg',
                        'link' => 'https://example.com/link6'
                    ]
                ]),
                'activo' => true
            ]
        ];

        foreach ($mostradores as $mostrador) {
            Mostrador::create($mostrador);
        }
    }
}
