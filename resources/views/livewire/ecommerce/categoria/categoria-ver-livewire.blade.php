<div>
    <style>
        .dividir {
            display: flex;
            width: 100%;
        }

        .dividir_1 {
            display: 30%;
            display: flex;
            flex-direction: column;
        }

        .dividir_2 {
            display: 70%;
        }
    </style>
    <div>
        <h1>{{ $categoria->nombre }}</h1>
    </div>

    <div class="dividir">
        <div class="dividir_1">
            <div>
                <h2>Categorias</h2>
                <ul>
                    @foreach ($categoriaFamilia as $categoria)
                        <li>
                            <a href="{{ url('category/' . $categoria->id . '/' . $categoria->slug) }}">
                                {{ $categoria->nombre }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="dividir_2">
            <h2>Productos</h2>

            <ul>
                @foreach ($productosConStock as $producto)
                    <li>
                        <a href="{{ url('product/' . $producto->id . '/' . $producto->slug) }}">
                            {{ $producto->nombre }}
                        </a>
                        <ul>
                            @foreach ($producto->variaciones as $variacion)
                                @foreach ($variacion->inventarios as $inventario)
                                    @if ($inventario->almacen_id == 1 && $inventario->stock > 0)
                                        <li>Variación ID: {{ $variacion->id }} - Stock: {{ $inventario->stock }}</li>
                                    @endif
                                @endforeach
                            @endforeach
                        </ul>
                        <br>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
