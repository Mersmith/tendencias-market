@if (!empty($p_elementos) && !empty($p_elementos->imagenes))

    @include('ecommerce.partials.titulo', [
        'p_contenido' => $p_elementos->nombre,
        'p_alineacion' => 'center',
        'p_color' => '#000000',
    ])

    <div class="columna_12 m_10_0">
        <div class="contenedor_grid_imagen_cuatro_elementos">
            @foreach ($p_elementos->imagenes as $item)
                <a href="{{ $item['link'] }}">
                    <img src="{{ $item['imagen_computadora'] }}" class="imagen_computadora" />
                    <img src="{{ $item['imagen_movil'] }}" class="imagen_movil" />
                </a>
            @endforeach
        </div>
    </div>
@endif
