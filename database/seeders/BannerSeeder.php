<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'nombre' => 'Banner 1',
                'imagen_computadora' => 'http://127.0.0.1:8000/assets/imagenes/banner/banner-tipo-1-computadora-1.jpg',
                'imagen_movil' => 'http://127.0.0.1:8000/assets/imagenes/banner/banner-tipo-1-movil-1.jpg',
                'link' => 'https://example.com/link1',
                'activo' => true
            ],
            [
                'nombre' => 'Banner 2',
                'imagen_computadora' => 'http://127.0.0.1:8000/assets/imagenes/banner/banner-tipo-2-computadora-1.jpg',
                'imagen_movil' => 'http://127.0.0.1:8000/assets/imagenes/banner/banner-tipo-2-movil-1.jpg',
                'link' => 'https://example.com/link2',
                'activo' => true
            ]
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
