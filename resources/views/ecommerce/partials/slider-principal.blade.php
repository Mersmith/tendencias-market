@if (!empty($p_elementos))
    <div x-data="dataSliderPrincipal({{ count($p_elementos->imagenes) }})" x-init="initSliderPrincipal" class="g_centrar_contenedor">
        <div class="partials_contenedor_slider_principal">
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
                <template x-for="index in [...Array(totalImagenes).keys()]" :key="index">
                    <button @click="setPosicionImagenActual(index)"
                        :class="posicionImagenActual === index ? 'boton_activo' : ''"></button>
                </template>
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
                    this.limpiarIntervalo();
                    this.iniciarIntervalo();
                },
                limpiarIntervalo() {
                    clearInterval(this.intervaloId);
                }
            };
        }
    </script>
@endif
