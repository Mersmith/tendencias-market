<div class="slider_imagen_cinco_elementos">
    @foreach ($elementos as $item)
        <div class="slide">
            <a href="{{ $item['link'] }}">
                <img src="{{ $item['imagen'] }}" />
                <p>{{ $item['nombre'] }}</p>
            </a>
        </div>
    @endforeach
</div>
