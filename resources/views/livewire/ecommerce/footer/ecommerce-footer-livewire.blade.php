<div>
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
</div>
