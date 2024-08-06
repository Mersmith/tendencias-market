@extends('layouts.ecommerce.layout-ecommerce')

@section('tituloPagina', 'Inicio')

@section('content')
    <div>
        @include('ecommerce.partials.banner', ['p_elemento' => $imagenBanner_1])

        @include('ecommerce.partials.slider-principal', ['sliders' => $sliders])

        <div class="centrar_contenido_pagina">
            <div class="contenido_pagina">

                {{--<div class="m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Ingresa a nuestras tiendas',
                        'p_alineacion' => 'center',
                        'p_color' => '#000000',
                    ])

                    <div class="columna_12 m_10_0">
                        @include('ecommerce.partials.grid-imagen-cuatro-elementos', [
                            'p_elementos' => $tiendas,
                        ])
                    </div>
                </div>--}}

                <div class="m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Aquí hay de todo',
                        'p_alineacion' => 'center',
                        'p_color' => '#4a4a4a',
                    ])

                    <div class="columna_12 m_10_0">
                        @include('ecommerce.partials.grid-imagen-seis-elementos', [
                            'p_elementos' => $mostrador_1,
                        ])
                    </div>
                </div>

                {{--<div class="columna_12 m_40_0">
                    @include('ecommerce.partials.slider-imagen-dos-elementos-tiempo', [
                        'p_elementos' => $dataSliderImagenDosElementosTiempo,
                    ])
                </div>--}}

                <div class="columna_12 m_b_10">
                    @include('ecommerce.partials.slider-imagen-cuatro-elementos', [
                        'p_elementos' => $dataSliderImagenCuatroElementos,
                    ])
                </div>

                <div class="m_b_10">
                    @include('ecommerce.partials.banner', ['p_elemento' => $imagenBanner_2])
                </div>

                <div class="columna_12">
                    @include('ecommerce.partials.slider-imagen-tres-elementos-publicidad-controles', [
                        'p_elementos' => $imagenesGridPublicidad_1,
                    ])

                    @include('ecommerce.partials.slider-imagen-tres-elementos-publicidad-controles', [
                        'p_elementos' => $imagenesGridPublicidad_2,
                    ])

                    @include('ecommerce.partials.slider-imagen-tres-elementos-publicidad-controles', [
                        'p_elementos' => $imagenesGridPublicidad_1,
                    ])

                    @include('ecommerce.partials.slider-imagen-tres-elementos-publicidad-controles', [
                        'p_elementos' => $imagenesGridPublicidad_2,
                    ])
                </div>

                <div class="m_b_10">
                    @include('ecommerce.partials.banner', ['p_elemento' => $imagenBanner_2])
                </div>

                {{--<div class="columna_12 m_40_0">
                    @include('ecommerce.partials.slider-imagen-tres-elementos-tiempo', [
                        'p_elementos' => $dataSliderImagenTresElementosTiempo,
                    ])
                </div>--}}

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Lo más TOP en zapatillas',
                        'p_alineacion' => 'left',
                        'p_color' => '#000000',
                    ])

                    @include('ecommerce.partials.slider-productos-seis-elementos', [
                        'p_elementos' => $producto_almacen_ecommerce,
                    ])
                </div>

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Novedades que te encantarán',
                        'p_alineacion' => 'left',
                        'p_color' => '#000000',
                    ])

                    @include('ecommerce.partials.slider-imagen-tres-elementos-publicidad-controles', [
                        'p_elementos' => $imagenesGridPublicidad_2,
                    ])
                </div>

                <div class="m_b_10">
                    @include('ecommerce.partials.banner', ['p_elemento' => $imagenBanner_3])
                </div>

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Lo más TOP en zapatillas',
                        'p_alineacion' => 'left',
                        'p_color' => '#000000',
                    ])

                    @include('ecommerce.partials.slider-productos-seis-elementos', [
                        'p_elementos' => $producto_almacen_ecommerce,
                    ])
                </div>

                <div class="m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Grandes marcas',
                        'p_alineacion' => 'center',
                        'p_color' => '#000000',
                    ])

                    <div class="columna_12 m_10_0">
                        @include('ecommerce.partials.grid-imagen-seis-elementos', [
                            'p_elementos' => $mostrador_2,
                        ])
                    </div>
                </div>

                <div class="columna_12 m_10_0">
                    @include('ecommerce.partials.slider-imagen-cuatro-elementos', [
                        'p_elementos' => $dataSliderImagenCincoElementos,
                    ])
                </div>

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.banner', ['p_elemento' => $imagenBanner_2])
                </div>

                <div class="m_40_0">
                    <div class="columna_12 m_10_0">
                        @include('ecommerce.partials.grid-imagen-seis-elementos', [
                            'p_elementos' => $mostrador_3,
                        ])
                    </div>
                </div>

            </div>
        </div>

        @include('ecommerce.partials.pie-pagina-categorias', ['p_elementos' => $categorias])

        {{--@include('ecommerce.partials.pie-pagina-enlaces')--}}
    </div>
@endsection
