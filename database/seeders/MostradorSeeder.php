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
                'nombre' => 'Aquí hay de todo',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'titulo' => 'Navidad',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-1.jpg',
                        'link' => 'https://example.com/link1'
                    ],
                    [
                        'id' => 2,
                        'titulo' => 'Juguetería',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-2.jpg',
                        'link' => 'https://example.com/link2'
                    ],
                    [
                        'id' => 3,
                        'titulo' => 'Televisores',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-3.jpg',
                        'link' => 'https://example.com/link3'
                    ],
                    [
                        'id' => 4,
                        'titulo' => 'Zapatillas',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-4.jpg',
                        'link' => 'https://example.com/link4'
                    ],
                    [
                        'id' => 5,
                        'titulo' => 'Mascotas',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-5.jpg',
                        'link' => 'https://example.com/link5'
                    ],
                    [
                        'id' => 6,
                        'titulo' => 'Regalos expres',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-6.jpg',
                        'link' => 'https://example.com/link6'
                    ],
                    [
                        'id' => 7,
                        'titulo' => 'Lentes',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-7.jpg',
                        'link' => 'https://example.com/link7'
                    ],
                    [
                        'id' => 8,
                        'titulo' => 'Verano',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-8.jpg',
                        'link' => 'https://example.com/link8'
                    ],
                    [
                        'id' => 9,
                        'titulo' => 'Dermo y cuidado personal',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-9.jpg',
                        'link' => 'https://example.com/link9'
                    ],
                    [
                        'id' => 10,
                        'titulo' => 'Pequeños electros',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-10.jpg',
                        'link' => 'https://example.com/link10'
                    ],
                    [
                        'id' => 11,
                        'titulo' => 'Muebles',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-11.jpg',
                        'link' => 'https://example.com/link11'
                    ],
                    [
                        'id' => 12,
                        'titulo' => 'Supermercado',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-1-12.jpg',
                        'link' => 'https://example.com/link12'
                    ]
                ]),
                'activo' => true
            ],
            [
                'nombre' => 'Grandes marcas',
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
                'nombre' => 'Muchos beneficios',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'titulo' => 'Envío gratis en miles de productos desde S/99',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-1.jpg',
                        'link' => 'https://example.com/link1'
                    ],
                    [
                        'id' => 2,
                        'titulo' => 'Promos y cupones',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-2.jpg',
                        'link' => 'https://example.com/link2'
                    ],
                    [
                        'id' => 3,
                        'titulo' => 'Emprendedores',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-3.jpg',
                        'link' => 'https://example.com/link3'
                    ],
                    [
                        'id' => 4,
                        'titulo' => 'Revisa tus pedidos en Mis Compras',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-4.jpg',
                        'link' => 'https://example.com/link4'
                    ],
                    [
                        'id' => 5,
                        'titulo' => 'Regístrate y descubre todos los beneficios',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/mostrador/mostrador-tipo-2-5.jpg',
                        'link' => 'https://example.com/link5'
                    ],
                    [
                        'id' => 6,
                        'titulo' => 'Regístrate y descubre todos los beneficios',
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
