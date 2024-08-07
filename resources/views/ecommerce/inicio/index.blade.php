@extends('layouts.ecommerce.layout-ecommerce')

@section('tituloPagina', 'Inicio')

@section('content')
    <div>
        @include('ecommerce.partials.banner', ['p_elemento' => $data_baner_1])

        @include('ecommerce.partials.slider-principal', ['p_elementos' => $data_slider_principal_1])

        <div class="centrar_contenido_pagina">
            <div class="contenido_pagina">

                <div class="m_40_0">
                    @include('ecommerce.partials.vitrina', [
                        'p_elementos' => $data_vitrina_1,
                    ])
                </div>

                <div class="m_40_0">
                    @include('ecommerce.partials.mostrador', [
                        'p_elementos' => $data_mostrador_1,
                    ])
                </div>

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.slider-imagen-dos-elementos-tiempo', [
                        'p_elementos' => $dataSliderImagenDosElementosTiempo,
                    ])
                </div>

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Solo hoy',
                        'p_alineacion' => 'left',
                        'p_color' => '#000000',
                    ])

                    @include('ecommerce.partials.slider-productos-seis-elementos', [
                        'p_elementos' => $data_productos_descuentos,
                    ])
                </div>

                <div class="columna_12 m_b_10">
                    @include('ecommerce.partials.aviso', [
                        'p_elementos' => $data_aviso_1,
                    ])
                </div>

                <div class="m_b_10">
                    @include('ecommerce.partials.banner', ['p_elemento' => $data_banner_2])
                </div>

                <div class="columna_12">
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
                </div>

                <div class="m_b_10">
                    @include('ecommerce.partials.banner', ['p_elemento' => $data_banner_2])
                </div>

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.slider-imagen-tres-elementos-tiempo', [
                        'p_elementos' => $dataSliderImagenTresElementosTiempo,
                    ])
                </div>

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Lo más TOP en zapatillas',
                        'p_alineacion' => 'left',
                        'p_color' => '#000000',
                    ])

                    @include('ecommerce.partials.slider-productos-seis-elementos', [
                        'p_elementos' => $data_productos,
                    ])
                </div>

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Novedades que te encantarán',
                        'p_alineacion' => 'left',
                        'p_color' => '#000000',
                    ])

                    @include('ecommerce.partials.grid', [
                        'p_elementos' => $data_grid_2,
                    ])
                </div>

                <div class="m_b_10">
                    @include('ecommerce.partials.banner', ['p_elemento' => $data_banner_3])
                </div>

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Lo más TOP en zapatillas',
                        'p_alineacion' => 'left',
                        'p_color' => '#000000',
                    ])

                    @include('ecommerce.partials.slider-productos-seis-elementos', [
                        'p_elementos' => $data_productos,
                    ])
                </div>

                <div class="m_40_0">
                    @include('ecommerce.partials.mostrador', [
                        'p_elementos' => $data_mostrador_2,
                    ])
                </div>

                <div class="columna_12 m_10_0">
                    @include('ecommerce.partials.aviso', [
                        'p_elementos' => $data_aviso_2,
                    ])
                </div>

                <div class="columna_12 m_40_0">
                    @include('ecommerce.partials.banner', ['p_elemento' => $data_banner_2])
                </div>

                <div class="m_40_0">
                    <div class="columna_12 m_10_0">
                        @include('ecommerce.partials.mostrador', [
                            'p_elementos' => $data_mostrador_3,
                        ])
                    </div>
                </div>

            </div>
        </div>

        @include('ecommerce.partials.enlaces-rapidos', ['p_elementos' => $data_enlaces_rapidos_1])
    </div>
@endsection
