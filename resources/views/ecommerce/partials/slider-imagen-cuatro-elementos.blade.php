<div class="contenedor_slider_imagen_cuatro_elementos">
    @foreach ($dataSliderImagenCuatroElementos as $item)
        <div class="item_slider">
            <a href="{{ $item['link'] }}">
                <img src="{{ $item['imagen'] }}" />
            </a>
        </div>
    @endforeach
</div>
