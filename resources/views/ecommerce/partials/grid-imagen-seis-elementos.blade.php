@if (!empty($p_elementos) && !empty($p_elementos->imagenes))
    <div x-data="dataGridImaSeisElem{{ $p_elementos->id }}()">
        <!-- CONTENEDOR GRID -->
        <div class="contenedor_grid_imagen_seis_elementos" :class="{ 'mostrar_todos': mostrarTodos }">
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
        <script>
            function dataGridImaSeisElem{{ $p_elementos->id }}() {
                return {
                    mostrarTodos: false
                }
            }
        </script>
    </div>
@endif
