@extends('layouts.ecommerce.layout-ecommerce')

@section('tituloPagina', 'Inicio')

@section('content')
    <div>
        @include('ecommerce.partials.banner', ['imagenBanner_1' => $imagenBanner_1])

        @include('ecommerce.partials.slider-principal', ['sliders' => $sliders])

        <div class="centrar_contenido_pagina">
            <div class="contenido_pagina">

                <div class="m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Ingresa a nuestras tiendas',
                        'p_alineacion' => 'center',
                        'p_color' => '#000000',
                    ])

                    <div className="columna_12 m_10_0">
                        @include('ecommerce.partials.grid-imagen-cuatro-elementos', [
                            'tiendas' => $tiendas,
                        ])
                    </div>
                </div>

                <div class="m_40_0">
                    @include('ecommerce.partials.titulo', [
                        'p_contenido' => 'Aquí hay de todo',
                        'p_alineacion' => 'center',
                        'p_color' => '#4a4a4a',
                    ])

                    <div className="columna_12 m_10_0">
                        @include('ecommerce.partials.grid-imagen-seis-elementos', [
                            'dataGridImagenSeisElementos_2' => $dataGridImagenSeisElementos_2,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
