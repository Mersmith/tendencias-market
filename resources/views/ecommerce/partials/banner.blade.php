@if (!empty($p_elemento))
    <div class="contenedor_banner">
        <a href="{{ $p_elemento['link'] }}">
            <img src="{{ $p_elemento['imagen_computadora'] }}" alt="Logo" class="imagen_computadora" />

            <img src="{{ $p_elemento['imagen_movil'] }}" alt="Logo" class="imagen_movil" />
        </a>
    </div>
@endif
