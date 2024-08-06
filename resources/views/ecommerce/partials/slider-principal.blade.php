@if (!empty($p_elementos))
    <div x-data="dataSliderPrincipal({{ count($p_elementos->imagenes) }})" x-init="initSliderPrincipal" class="centrar_contenedor">
        <div class="contenedor_slider_principal">
            <div class="slider">
                @foreach ($p_elementos->imagenes as $index => $slide)
                    <div class="item_slider"
                        x-bind:class="posicionImagenActual === @json($index) ? 'imagen_activo' : 'imagen_oculto'">
                        <a href="{{ $slide['link'] }}">
                            <img src="{{ $slide['imagen_computadora'] }}" alt="" class="imagen_computadora" />
                            <img src="{{ $slide['imagen_movil'] }}" alt="" class="imagen_movil" />
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="control_botones">
                <button @click="botonRetroceder" class="boton_retroceder">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button @click="botonSiguiente" class="boton_siguiente">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <div class="paginacion_botones">
                @foreach ($p_elementos->imagenes as $index => $slide)
                    <button @click="setPosicionImagenActual(@json($index))" class="boton_paginacion"
                        :class="posicionImagenActual === @json($index) ? 'imagen_activo' : ''"></button>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function dataSliderPrincipal(totalImagenes) {
            return {
                posicionImagenActual: 0,
                totalImagenes: totalImagenes,
                intervaloId: null,
                initSliderPrincipal() {
                    this.iniciarIntervalo();
                },
                iniciarIntervalo() {
                    this.intervaloId = setInterval(() => {
                        this.botonSiguiente();
                    }, 5000);
                },
                botonRetroceder() {
                    this.posicionImagenActual = (this.posicionImagenActual - 1 + this.totalImagenes) % this.totalImagenes;
                },
                botonSiguiente() {
                    this.posicionImagenActual = (this.posicionImagenActual + 1) % this.totalImagenes;
                },
                setPosicionImagenActual(index) {
                    this.posicionImagenActual = index;
                    clearInterval(this.intervaloId);
                    this.iniciarIntervalo();
                },
                limpiarIntervalo() {
                    clearInterval(this.intervaloId);
                }
            };
        }
    </script>
@endif
