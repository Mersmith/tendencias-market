<?php

namespace Database\Seeders;

use App\Models\EcommerceFooter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcommerceFooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $footer = [
            'enlaces_rapidos' => json_encode([
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
                    ]
                ],
            ]),
            'redes_sociales' => json_encode([
                [
                    'id' => 1,
                    'icono' => '<i class="fa-brands fa-facebook"></i>',
                    'link' => 'https://example.com/link1'
                ],
                [
                    'id' => 2,
                    'icono' => '<i class="fa-brands fa-tiktok"></i>',
                    'link' => 'https://example.com/link2'
                ],
                [
                    'id' => 3,
                    'icono' => '<i class="fa-brands fa-instagram"></i>',
                    'link' => 'https://example.com/link3'
                ],
                [
                    'id' => 4,
                    'icono' => '<i class="fa-brands fa-youtube"></i>',
                    'link' => 'https://example.com/link4'
                ]
            ]),
            'terminos' => json_encode([
                [
                    'id' => 1,
                    'nombre' => 'Política de privacidad',
                    'link' => 'https://example.com/link1'
                ],
                [
                    'id' => 2,
                    'nombre' => 'Política de cookies',
                    'link' => 'https://example.com/link2'
                ],
                [
                    'id' => 3,
                    'nombre' => 'Términos y condiciones',
                    'link' => 'https://example.com/link3'
                ],
                [
                    'id' => 4,
                    'nombre' => 'Políticas de publicidad',
                    'link' => 'https://example.com/link4'
                ]
            ]),
            'derechos' => '© TODOS LOS DERECHOS RESERVADOS',
            'direccion' => 'Av. Emprendedores 369, La Molina, Perú',
            'activo' => true
        ];

        EcommerceFooter::create($footer);
    }
}
