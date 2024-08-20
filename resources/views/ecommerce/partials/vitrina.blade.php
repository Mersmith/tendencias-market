@if (!empty($p_elementos) && !empty($p_elementos->imagenes))

    @if ($p_elementos->nombre)
        @include('ecommerce.partials.titulo', [
            'p_contenido' => $p_elementos->nombre,
            'p_alineacion' => 'center',
            'p_color' => '#000000',
        ])
        </div>
    @endif

    <div class="partials_contenedor_vitrina">
        @foreach ($p_elementos->imagenes as $item)
            <a href="{{ $item['link'] }}">
                <img src="{{ $item['imagen_computadora'] }}" class="imagen_computadora" />
                <img src="{{ $item['imagen_movil'] }}" class="imagen_movil" />
            </a>
        @endforeach
    </div>
@endif
