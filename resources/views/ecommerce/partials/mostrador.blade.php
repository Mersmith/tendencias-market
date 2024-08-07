@if (!empty($p_elementos) && !empty($p_elementos->imagenes))
    @include('ecommerce.partials.titulo', [
        'p_contenido' => $p_elementos->nombre,
        'p_alineacion' => 'center',
        'p_color' => '#4a4a4a',
    ])

    <div x-data="dataMostrador{{ $p_elementos->id }}()" class="partials_contenedor_mostrador">
        <!-- CONTENEDOR GRID -->
        <div class="grid_mostrador" :class="{ 'mostrar_todos': mostrarTodos }">
            @foreach ($p_elementos->imagenes as $index => $item)
                <div class="item">
                    <a href="{{ $item['link'] }}">
                        <!-- IMAGENES -->
                        <img src="{{ $item['imagen'] }}" alt="{{ $item['titulo'] }}" />
                        <p>{{ $item['titulo'] }}</p>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- CONTENEDOR CONTROL -->
        @if (count($p_elementos->imagenes) > 6)
            <div class="contenedor_control_mostrar">
                <p x-show="!mostrarTodos" @click="mostrarTodos = true">
                    Mostrar más <span class="invertido">^</span>
                </p>
                <p x-show="mostrarTodos" @click="mostrarTodos = false">
                    Mostrar menos <span class="normal">^</span>
                </p>
            </div>
        @endif
    </div>

    <script>
        function dataMostrador{{ $p_elementos->id }}() {
            return {
                mostrarTodos: false
            }
        }
    </script>
@endif
