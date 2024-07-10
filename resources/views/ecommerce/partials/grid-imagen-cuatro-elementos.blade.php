<div class="contenedor_grid_imagen_cuatro_elementos">
    @foreach($tiendas as $tienda)
        <a href="{{ $tienda['link'] }}">
            <img src="{{ $tienda['imagenComputadora'] }}" class="imagen_computadora" />
            <img src="{{ $tienda['imagenMovil'] }}" class="imagen_movil" />
        </a>
    @endforeach
</div>