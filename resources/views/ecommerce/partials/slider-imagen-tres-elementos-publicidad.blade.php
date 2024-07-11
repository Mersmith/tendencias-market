<div class="contenedor_promociones slider_img_tres_ele_publi">
    @foreach ($p_elementos as $item)
        <div
            class="slide @if ($item['width'] === 50) width_50_por @elseif($item['width'] === 25) width_25_por @endif">
            <a href="{{ $item['link'] }}">
                <img src="{{ $item['imagenComputadora'] }}" class="imagen_computadora" />
                <img src="{{ $item['imagenMovil'] }}" class="imagen_movil" />
            </a>
        </div>
    @endforeach
</div>
