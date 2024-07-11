<div class="contenedor_promociones slider_img_cinco_ele">
    @foreach ($p_elementos as $item)
        <div class="slide">
            <a href="{{ $item['link'] }}">
                <img src="{{ $item['imagen'] }}" />
                <p>{{ $item['nombre'] }}</p>
            </a>
        </div>
    @endforeach
</div>
