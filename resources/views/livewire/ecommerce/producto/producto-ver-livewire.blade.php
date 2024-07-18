<div>
    <h1>{{ $producto->nombre }}</h1>
    <p>{{ $producto->descripcion }}</p>
    <p>Categoria: {{ $producto->categoria->nombre }}</p>
    <p>Marca: {{ $producto->marca->nombre }}</p>
    <p>Precio: {{ $producto->precio }}</p>
    <!-- Muestra otros detalles del producto según tu necesidad -->
    <div>
        @foreach ($producto->imagens as $imagen)
            <img src="{{ $imagen->url }}" alt="{{ $imagen->titulo }}">
        @endforeach
    </div>
    
    @if ($producto->variaciones)
        @foreach ($producto->variaciones as $variacion)
            <h2>Variación: {{ $variacion->id }}</h2>
            <p>Color: {{ $variacion->color->nombre ?? 'N/A' }}</p>
            <p>Talla: {{ $variacion->talla->nombre ?? 'N/A' }}</p>
            <p>Stock: {{ $variacion->stock }}</p>
        @endforeach
    @endif
</div>
