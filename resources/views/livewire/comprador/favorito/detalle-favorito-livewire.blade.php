<div>
    <h2>Mis Favoritos</h2>

    @if ($favoritos->isEmpty())
        <p>No tienes productos en tus favoritos.</p>
    @else
        <ul>
            @foreach ($favoritos as $producto)
                <li>
                    <a
                        href="{{ route('ecommerce.producto.vista.ver', ['id' => $producto->id, 'slug' => $producto->slug]) }}">
                        <span>{{ $producto->id }} {{ $producto->nombre }}</span>
                    </a>
                    <button wire:click="eliminarFavorito({{ $producto->id }})">
                        Eliminar favorito
                    </button>
                </li>
                <br>
            @endforeach
        </ul>
    @endif
</div>
