<div class="g_panel">

    <div class="g_titulo">
        <h2>Mis Favoritos</h2>
    </div>

    @if ($favoritos->isEmpty())
        <p>No tienes productos en tus favoritos.</p>
    @else
        <div class="contenedor_favorito">
            @foreach ($favoritos as $producto)
                <div class="item_producto">
                    <div class="contenedor_imagen">
                        <img src="" alt="">
                    </div>

                    <div class="info_producto">
                        <a
                            href="{{ route('ecommerce.producto.vista.ver', ['id' => $producto->producto_id, 'slug' => $producto->producto_url]) }}">
                            <span>{{ $producto->producto_id }} {{ $producto->producto_nombre }}</span>
                        </a>
                        <button wire:click="eliminarFavorito({{ $producto->producto_id }})">
                            Eliminar favorito
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
