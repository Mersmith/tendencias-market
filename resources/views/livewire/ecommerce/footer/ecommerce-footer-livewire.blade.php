<div>
    <div x-data="dataEcommerceFooter">
        <div class="contenedor_enlaces_rapidos">
            <div class="centrar_contenido_pagina">
                <div class="contenido_pagina">
                    <div class="columna_12">
                        <div class="grid_contenedor_items">
                            @foreach ($enlaces_rapidos as $index => $data)
                                <div class="contenedor_item">
                                    <!-- CONTENEDOR TITULO -->
                                    <div @click="toggleAccordion({{ $index }})" class="contenedor_titulo">
                                        <p>{{ $data['titulo'] }}</p>

                                        <!-- CONTENEDOR CONTROL -->
                                        <span class="contenedor_control"
                                            x-text="itemIndex === {{ $index }} ? '-' : '+'"></span>
                                    </div>

                                    <!-- CONTENEDOR ACORDEON -->
                                    <ul class="contenedor_acordeon"
                                        :class="{ 'mostrar': itemIndex === {{ $index }} }">
                                        @foreach ($data['elementos'] as $elemento)
                                            <li>
                                                <a href="{{ $elemento['link'] }}">{{ $elemento['nombre'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="footer">
            <div class="centrar_contenido_pagina">
                <div class="contenido_pagina">
                    <div class="columna_12">
                        <!-- CONTENEDOR REDES - TERMINOS -->
                        <div class="contenedor_redes_terminos">
                            <!-- CONTENEDOR REDES -->
                            <div class="contenedor_redes">
                                @foreach ($redes_sociales as $item)
                                    <a>{!! $item['icono'] !!}</a>
                                @endforeach
                            </div>

                            <!-- CONTENEDOR TERMINOS -->
                            <div class="contenedor_terminos">
                                @foreach ($terminos as $item)
                                    <a>{{ $item['nombre'] }}</a>
                                @endforeach
                            </div>
                        </div>

                        <!-- CONTENEDOR DERECHOS -->
                        <div class="contenedor_derechos">
                            <p>{{ $derechos }}</p>
                            <span>{{ $direccion }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function dataEcommerceFooter() {
            return {
                itemIndex: null,
                toggleAccordion(index) {
                    if (this.itemIndex === index) {
                        this.itemIndex = null;
                    } else {
                        this.itemIndex = index;
                    }
                }
            }
        }
    </script>
</div>
