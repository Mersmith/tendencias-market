<x-ecommerce-layout>
    @section('tituloPagina', 'Tendencias Market | Todos los productos que quieres están aquí!')
    @section('descripcion', 'Tendencias Market')

    <div class="g_contenedor_pagina">
        @include('ecommerce.partials.banner', ['p_elemento' => $data_baner_1])

        @include('ecommerce.partials.slider-principal', ['p_elemento' => $data_slider_principal_1])

        <div class="g_centrar_pagina">
            <div class="gaaaaaaaaaaa">
                @include('ecommerce.partials.vitrina', [
                    'p_elemento' => $data_vitrina_1,
                ])

                @include('ecommerce.partials.mostrador', [
                    'p_elemento' => $data_mostrador_1,
                ])

                @include('ecommerce.partials.temporizador', [
                    'p_elemento' => $data_temporizador_1,
                ])

                @include('ecommerce.partials.aviso', [
                    'p_elemento' => $data_aviso_1,
                ])

                @include('ecommerce.partials.temporizador', [
                    'p_elemento' => $data_temporizador_2,
                ])

                @include('ecommerce.partials.banner', ['p_elemento' => $data_banner_2])

                <div>
                    @include('ecommerce.partials.grid', [
                        'p_elemento' => $data_grid_1,
                    ])

                    @include('ecommerce.partials.grid', [
                        'p_elemento' => $data_grid_2,
                    ])

                    @include('ecommerce.partials.grid', [
                        'p_elemento' => $data_grid_3,
                    ])

                    @include('ecommerce.partials.grid', [
                        'p_elemento' => $data_grid_4,
                    ])
                </div>

                @include('ecommerce.partials.temporizador', [
                    'p_elemento' => $data_temporizador_3,
                ])

                @include('ecommerce.partials.banner', ['p_elemento' => $data_banner_3])

                @include('ecommerce.partials.slider-productos', [
                    'p_elemento' => $data_slide_producto_1,
                ])

                @include('ecommerce.partials.grid', [
                    'p_elemento' => $data_grid_5,
                ])

                @include('ecommerce.partials.banner', ['p_elemento' => $data_banner_4])

                @include('ecommerce.partials.slider-productos', [
                    'p_elemento' => $data_slide_producto_2,
                ])

                @include('ecommerce.partials.slider-productos', [
                    'p_elemento' => $data_slide_producto_descuentos,
                ])

                @include('ecommerce.partials.mostrador', [
                    'p_elemento' => $data_mostrador_2,
                ])

                @include('ecommerce.partials.aviso', [
                    'p_elemento' => $data_aviso_2,
                ])

                @include('ecommerce.partials.banner', ['p_elemento' => $data_banner_5])

                @include('ecommerce.partials.mostrador', [
                    'p_elemento' => $data_mostrador_3,
                ])
            </div>
        </div>

        @include('ecommerce.partials.enlaces-rapidos', ['p_elemento' => $data_enlaces_rapidos_1])
    </div>
</x-ecommerce-layout>
