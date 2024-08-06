@if (!empty($p_elementos))
    <div x-data="dataEnlacesRapidos()" x-init="init()">
        <div class="contendor_enlaces_rapidos">
            <div class="centrar_contenido_pagina">
                <div class="contenido_pagina">
                    <div class="columna_12">
                        @include('ecommerce.partials.titulo-icono', [
                            'p_contenido' => $p_elementos->nombre,
                            'p_alineacion' => 'center',
                            'p_color' => '#4a4a4a',
                        ])

                        {{-- CONTENEDOR DE CATEGORÍAS --}}
                        <div class="contenedor_marcas">
                            @foreach ($p_elementos->enlaces as $index => $categoria)
                                <div x-show="shouldShowElement({{ $index }})">
                                    <p>{{ $categoria['titulo'] }}</p>
                                    <ul>
                                        @foreach ($categoria['elementos'] as $elemento)
                                            <li><a href="{{ $elemento['link'] }}">{{ $elemento['nombre'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>

                        {{-- CONTENEDOR MOSTRAR --}}
                        <div class="contenedor_control_mostrar" x-show="cantidadElementos == 2">
                            <p @click="mostrarMas" x-show="!mostrarTodos">Mostrar más <span class="invertido">^</span>
                            </p>
                            <p @click="mostrarMenos" x-show="mostrarTodos">Mostrar menos <span class="normal">^</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function dataEnlacesRapidos() {
            return {
                cantidadElementos: 4,
                mostrarTodos: false,

                init() {
                    this.handleResize();
                    window.addEventListener('resize', this.handleResize.bind(this));
                },

                handleResize() {
                    const windowWidth = window.innerWidth;
                    this.cantidadElementos = windowWidth > 900 ? 4 : 2;
                },

                shouldShowElement(index) {
                    return this.mostrarTodos || index < this.cantidadElementos;
                },

                mostrarMas() {
                    this.mostrarTodos = true;
                },

                mostrarMenos() {
                    this.mostrarTodos = false;
                }
            };
        }
    </script>
@endif
