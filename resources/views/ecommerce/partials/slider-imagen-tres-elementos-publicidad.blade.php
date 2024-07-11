<div class="slider_imagen_tres_elementos_publicidad">
    @foreach ($imagenesGridPublicidad_1 as $item)
        <div
            class="item_slider @if ($item['width'] === 50) item_50 @elseif($item['width'] === 25) item_25 @endif">
            <a href="{{ $item['link'] }}">
                <img src="{{ $item['imagenComputadora'] }}" class="imagen_computadora" />
                <img src="{{ $item['imagenMovil'] }}" class="imagen_movil" />
            </a>
        </div>
    @endforeach
</div>
