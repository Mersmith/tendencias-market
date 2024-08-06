@if (!empty($p_elementos) && !empty($p_elementos->imagenes))
    @include('ecommerce.partials.titulo', [
        'p_contenido' => $p_elementos->nombre,
        'p_alineacion' => 'center',
        'p_color' => '#4a4a4a',
    ])

    <div class="columna_12 m_10_0">
        <div x-data="dataGridImaSeisElem{{ $p_elementos->id }}()">
            <!-- CONTENEDOR GRID -->
            <div class="contenedor_mostrador" :class="{ 'mostrar_todos': mostrarTodos }">
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
                    <p x-show="!mostrarTodos" @click="mostrarTodos = true" class="mostrar-mas">
                        Mostrar más <span class="invertido">^</span>
                    </p>
                    <p x-show="mostrarTodos" @click="mostrarTodos = false" class="mostrar-menos">
                        Mostrar menos <span class="normal">^</span>
                    </p>
                </div>
            @endif

        </div>
    </div>

    <script>
        function dataGridImaSeisElem{{ $p_elementos->id }}() {
            return {
                mostrarTodos: false
            }
        }
    </script>
@endif
