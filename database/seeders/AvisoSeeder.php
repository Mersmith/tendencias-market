<?php

namespace Database\Seeders;

use App\Models\Aviso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $avisos = [
            [
                'nombre' => 'Aviso 1',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'titulo' => 'Navidad',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/aviso/aviso-tipo-1-1.jpg',
                        'link' => 'https://example.com/link1'
                    ],
                    [
                        'id' => 2,
                        'titulo' => 'Juguetería',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/aviso/aviso-tipo-1-2.jpg',
                        'link' => 'https://example.com/link2'
                    ],
                    [
                        'id' => 3,
                        'titulo' => 'Televisores',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/aviso/aviso-tipo-1-3.jpg',
                        'link' => 'https://example.com/link3'
                    ],
                    [
                        'id' => 4,
                        'titulo' => 'Zapatillas',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/aviso/aviso-tipo-1-4.jpg',
                        'link' => 'https://example.com/link4'
                    ]
                ]),
                'activo' => true
            ],
            [
                'nombre' => 'Aviso 2',
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/aviso/aviso-tipo-2-1.jpg',
                        'link' => 'https://example.com/link1'
                    ],
                    [
                        'id' => 2,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/aviso/aviso-tipo-2-2.jpg',
                        'link' => 'https://example.com/link2'
                    ],
                    [
                        'id' => 3,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/aviso/aviso-tipo-2-3.jpg',
                        'link' => 'https://example.com/link3'
                    ],
                    [
                        'id' => 4,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/aviso/aviso-tipo-2-4.jpg',
                        'link' => 'https://example.com/link4'
                    ],
                    [
                        'id' => 5,
                        'titulo' => '',
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/aviso/aviso-tipo-2-5.jpg',
                        'link' => 'https://example.com/link5'
                    ]
                ]),
                'activo' => true
            ]
        ];



        foreach ($avisos as $aviso) {
            Aviso::create($aviso);
        }
    }
}
