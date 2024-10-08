<?php

namespace Database\Seeders;

use App\Models\Temporizador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class TemporizadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $temporizadores = [
            [
                'nombre' => 'temporizador 1',
                'titulo' => 'Final de hoy',
                'fecha_fin' => Carbon::today()->endOfDay(),//Final de hoy
                'cantidad_mostrar' => 2,
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/temporizador/temporizador-tipo-1-1.jpg',
                        'link' => 'https://example.com/link1'
                    ],
                    [
                        'id' => 2,
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/temporizador/temporizador-tipo-1-2.jpg',
                        'link' => 'https://example.com/link2'
                    ],
                    [
                        'id' => 3,
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/temporizador/temporizador-tipo-1-3.jpg',
                        'link' => 'https://example.com/link3'
                    ]
                ]),
                'activo' => true
            ],
            [
                'nombre' => 'temporizador 2',
                'titulo' => 'Final de mañana',
                'fecha_fin' => Carbon::tomorrow()->endOfDay(),//Final de mañana.
                'cantidad_mostrar' => 3,
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/temporizador/temporizador-tipo-2-1.jpg',
                        'link' => 'https://example.com/link1'
                    ],
                    [
                        'id' => 2,
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/temporizador/temporizador-tipo-2-2.jpg',
                        'link' => 'https://example.com/link2'
                    ],
                    [
                        'id' => 3,
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/temporizador/temporizador-tipo-2-3.jpg',
                        'link' => 'https://example.com/link3'
                    ]
                ]),
                'activo' => true
            ],
            [
                'nombre' => 'temporizador 3',
                'titulo' => 'Final del día dentro de 7 días',
                'fecha_fin' => Carbon::now()->addDays(7)->endOfDay(),// Final del día dentro de 7 días a partir de ahora.
                'cantidad_mostrar' => 1,
                'imagenes' => json_encode([
                    [
                        'id' => 1,
                        'imagen' => 'http://127.0.0.1:8000/assets/imagenes/temporizador/temporizador-tipo-1-1.jpg',
                        'link' => 'https://example.com/link1'
                    ],
                ]),
                'activo' => true
            ]
        ];


        foreach ($temporizadores as $temporizador) {
            Temporizador::create($temporizador);
        }
    }
}
