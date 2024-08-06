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
                    'titulo' => 'Te ayudamos',
                    'elementos' => [
                        ['nombre' => 'Libro de reclamaciones', 'link' => 'www.google.com'],
                        ['nombre' => 'Atención por WhatsApp', 'link' => 'www.google.com'],
                        ['nombre' => 'Centro de ayuda', 'link' => '/informes/centro-ayuda'],
                        ['nombre' => 'Tipos de entrega', 'link' => 'www.google.com'],
                        ['nombre' => 'Cambios y devoluciones', 'link' => 'www.google.com'],
                        ['nombre' => 'Seguimiento de mi orden', 'link' => 'www.google.com'],
                        ['nombre' => 'Boletas y facturas', 'link' => 'www.google.com'],
                        ['nombre' => 'Política de prevención de delitos', 'link' => 'www.google.com'],
                        ['nombre' => 'Textos legales', 'link' => 'www.google.com'],
                        ['nombre' => 'Inversionistas', 'link' => 'www.google.com'],
                        ['nombre' => 'Canal de integridad - Integrity channel', 'link' => 'www.google.com'],
                    ]
                ],
                [
                    'id' => 2,
                    'titulo' => 'Sé parte de Tendencias',
                    'elementos' => [
                        ['nombre' => 'Vende con nosotros', 'link' => '/informes/vende-con-nosotros'],
                        ['nombre' => 'Trabaja con nosotros', 'link' => 'www.google.com'],
                        ['nombre' => 'Venta empresa', 'link' => '/informes/venta-empresa'],
                    ]
                ],
                [
                    'id' => 3,
                    'titulo' => 'Únete a nuestros programas',
                    'elementos' => [
                        ['nombre' => 'Novios Tendencias', 'link' => 'www.google.com'],
                        ['nombre' => 'Puntos', 'link' => 'www.google.com'],
                        ['nombre' => 'Pide tu Tarjeta', 'link' => 'www.google.com'],
                        ['nombre' => 'Cyber WOW 2024', 'link' => 'www.google.com'],
                        ['nombre' => 'Hot Sale', 'link' => 'www.google.com'],
                        ['nombre' => 'Black Friday', 'link' => 'www.google.com'],
                    ]
                ],
                [
                    'id' => 4,
                    'titulo' => 'Nuestras empresas',
                    'elementos' => [
                        ['nombre' => 'Banco Tendencias', 'link' => 'www.google.com'],
                        ['nombre' => 'Seguros Tendencias', 'link' => 'www.google.com'],
                        ['nombre' => 'Tendencias', 'link' => 'www.google.com'],
                        ['nombre' => 'Nuestra empresa', 'link' => 'www.google.com'],
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
