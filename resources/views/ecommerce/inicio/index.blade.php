<x-ecommerce-layout>
    @section('tituloPagina', 'Tendencias Market | Todos los productos que quieres están aquí!')
    @section('descripcion', 'Tendencias Market')

    <div>
        @include('ecommerce.partials.banner', ['p_elemento' => $data_baner_1])

        @include('ecommerce.partials.slider-principal', ['p_elementos' => $data_slider_principal_1])

        <div class="g_centrar_contenido_pagina">
            <div class="g_contenido_pagina">

                @include('ecommerce.partials.vitrina', [
                    'p_elementos' => $data_vitrina_1,
                ])

                @include('ecommerce.partials.mostrador', [
                    'p_elementos' => $data_mostrador_1,
                ])

                @include('ecommerce.partials.temporizador', [
                    'p_elementos' => $data_temporizador_1,
                ])

                @include('ecommerce.partials.aviso', [
                    'p_elementos' => $data_aviso_1,
                ])

                {{-- @include('ecommerce.partials.banner', ['p_elemento' => $data_banner_2]) --}}


                @include('ecommerce.partials.grid', [
                    'p_elementos' => $data_grid_1,
                ])

                @include('ecommerce.partials.grid', [
                    'p_elementos' => $data_grid_2,
                ])

                @include('ecommerce.partials.grid', [
                    'p_elementos' => $data_grid_1,
                ])

                @include('ecommerce.partials.grid', [
                    'p_elementos' => $data_grid_3,
                ])

                {{--@include('ecommerce.partials.banner', ['p_elemento' => $data_banner_2])--}}

                @include('ecommerce.partials.slider-productos', [
                    'p_elementos' => $data_slide_producto,
                ])

                @include('ecommerce.partials.grid', [
                    'p_elementos' => $data_grid_2,
                ])

                {{--@include('ecommerce.partials.banner', ['p_elemento' => $data_banner_3])--}}

                @include('ecommerce.partials.slider-productos', [
                    'p_elementos' => $data_slide_producto,
                ])

                @include('ecommerce.partials.slider-productos', [
                    'p_elementos' => $data_slide_producto_descuentos,
                ])

                {{--@include('ecommerce.partials.mostrador', [
                    'p_elementos' => $data_mostrador_2,
                ])--}}

                {{--@include('ecommerce.partials.aviso', [
                    'p_elementos' => $data_aviso_2,
                ])--}}

                {{--@include('ecommerce.partials.banner', ['p_elemento' => $data_banner_2])--}}

                {{--@include('ecommerce.partials.mostrador', [
                    'p_elementos' => $data_mostrador_3,
                ])--}}

            </div>
        </div>

        @include('ecommerce.partials.enlaces-rapidos', ['p_elementos' => $data_enlaces_rapidos_1])
    </div>
</x-ecommerce-layout>
