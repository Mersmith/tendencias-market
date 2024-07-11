<div class="contenedor_promociones slider_img_cuatro_ele">
    @foreach ($p_elementos as $item)
        <div class="slide">
            <a href="{{ $item['link'] }}">
                <img src="{{ $item['imagen'] }}" />
            </a>
        </div>
    @endforeach
</div>
