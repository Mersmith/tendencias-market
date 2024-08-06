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
                'nombre' => 'Encuentra todo en un solo lugar',
                'enlaces' => json_encode([
                    [
                        'id' => 1,
                        'titulo' => 'Productos Populares',
                        'elementos' => [
                            ['nombre' => 'Muebles', 'link' => 'www.google.com'],
                            ['nombre' => 'Mancuernas', 'link' => 'www.google.com'],
                            ['nombre' => 'Refrigeradora side by side', 'link' => 'www.google.com'],
                            ['nombre' => 'Lavavajillas', 'link' => 'www.google.com'],
                            ['nombre' => 'Nintendo Switch', 'link' => 'www.google.com'],
                            ['nombre' => 'Muebles de sala', 'link' => 'www.google.com'],
                            ['nombre' => 'Plancha', 'link' => 'www.google.com'],
                            ['nombre' => 'Almohadas', 'link' => 'www.google.com'],
                            ['nombre' => 'Vestidos', 'link' => 'www.google.com'],
                            ['nombre' => 'Televisor LED', 'link' => 'www.google.com'],
                        ],
                    ],
                    [
                        'id' => 2,
                        'titulo' => 'Categorías destacadas',
                        'elementos' => [
                            ['nombre' => 'Zapatillas', 'link' => 'www.google.com'],
                            ['nombre' => 'Moda mujer', 'link' => 'www.google.com'],
                            ['nombre' => 'Celulares', 'link' => 'www.google.com'],
                            ['nombre' => 'Televisores', 'link' => 'www.google.com'],
                            ['nombre' => 'Electrohogar', 'link' => 'www.google.com'],
                            ['nombre' => 'Tecnología', 'link' => 'www.google.com'],
                            ['nombre' => 'Ventiladores', 'link' => 'www.google.com'],
                            ['nombre' => 'Laptops', 'link' => 'www.google.com'],
                            ['nombre' => 'Audífonos', 'link' => 'www.google.com'],
                            ['nombre' => 'Refrigerador', 'link' => 'www.google.com'],
                        ],
                    ],
                    [
                        'id' => 3,
                        'titulo' => 'Marcas favoritas',
                        'elementos' => [
                            ['nombre' => 'Mango', 'link' => 'www.google.com'],
                            ['nombre' => 'Cerave', 'link' => 'www.google.com'],
                            ['nombre' => 'Aldo', 'link' => 'www.google.com'],
                            ['nombre' => 'Olaplex', 'link' => 'www.google.com'],
                            ['nombre' => 'Samsung', 'link' => 'www.google.com'],
                            ['nombre' => 'Apple', 'link' => 'www.google.com'],
                            ['nombre' => 'Puma', 'link' => 'www.google.com'],
                            ['nombre' => 'The Ordinary', 'link' => 'www.google.com'],
                            ['nombre' => 'Sybilla', 'link' => 'www.google.com'],
                            ['nombre' => 'Adidas', 'link' => 'www.google.com'],
                        ],
                    ],
                    [
                        'id' => 4,
                        'titulo' => 'Destacados',
                        'elementos' => [
                            ['nombre' => 'Airpods', 'link' => 'www.google.com'],
                            ['nombre' => 'Xiaomi 12 Pro', 'link' => 'www.google.com'],
                            ['nombre' => 'Nike Air Force 1', 'link' => 'www.google.com'],
                            ['nombre' => 'iPhone 14', 'link' => 'www.google.com'],
                            ['nombre' => 'Laptop gamer', 'link' => 'www.google.com'],
                            ['nombre' => 'Samsung a53', 'link' => 'www.google.com'],
                            ['nombre' => 'Alexa', 'link' => 'www.google.com'],
                            ['nombre' => 'Motorola Moto g22', 'link' => 'www.google.com'],
                            ['nombre' => 'Samsung Galaxy a54', 'link' => 'www.google.com'],
                            ['nombre' => 'Cyber Wow', 'link' => 'www.google.com'],
                        ],
                    ],
                ]),
                'activo' => true
            ],
            [
                'nombre' => 'Pie',
                'enlaces' => json_encode([
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
                        'titulo' => 'Sé parte de falabella.com',
                        'elementos' => [
                            ['nombre' => 'Vende con nosotros', 'link' => '/informes/vende-con-nosotros'],
                            ['nombre' => 'Trabaja con nosotros', 'link' => 'www.google.com'],
                            ['nombre' => 'Venta empresa', 'link' => '/informes/venta-empresa'],
                            ['nombre' => 'Tareas', 'link' => '/dashboard/tareas'],
                        ]
                    ],
                    [
                        'id' => 3,
                        'titulo' => 'Únete a nuestros programas',
                        'elementos' => [
                            ['nombre' => 'Novios Falabella', 'link' => 'www.google.com'],
                            ['nombre' => 'CMR Puntos', 'link' => 'www.google.com'],
                            ['nombre' => 'Pide tu CMR', 'link' => 'www.google.com'],
                            ['nombre' => 'Cyber WOW 2023', 'link' => 'www.google.com'],
                            ['nombre' => 'Hot Sale', 'link' => 'www.google.com'],
                            ['nombre' => 'Black Friday', 'link' => 'www.google.com'],
                        ]
                    ],
                    [
                        'id' => 4,
                        'titulo' => 'Nuestras empresas',
                        'elementos' => [
                            ['nombre' => 'Banco Falabella', 'link' => 'www.google.com'],
                            ['nombre' => 'Seguros Falabella', 'link' => 'www.google.com'],
                            ['nombre' => 'Saga Falabella', 'link' => 'www.google.com'],
                            ['nombre' => 'Sodimac', 'link' => 'www.google.com'],
                            ['nombre' => 'Tottus', 'link' => 'www.google.com'],
                            ['nombre' => 'Linio', 'link' => 'www.google.com'],
                            ['nombre' => 'Tottus app', 'link' => 'www.google.com'],
                            ['nombre' => 'Nuestra empresa', 'link' => 'www.google.com'],
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
