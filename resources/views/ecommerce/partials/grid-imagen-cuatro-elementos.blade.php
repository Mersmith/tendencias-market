<div class="contenedor_grid_imagen_cuatro_elementos">
    @foreach ($p_elementos as $item)
        <a href="{{ $item['link'] }}">
            <img src="{{ $item['imagenComputadora'] }}" class="imagen_computadora" />
            <img src="{{ $item['imagenMovil'] }}" class="imagen_movil" />
        </a>
    @endforeach
</div>