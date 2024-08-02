@if (!empty($sliders))
    <div x-data="dataSliderPrincipal({{ json_encode($sliders->imagenes) }})" class="centrar_contenedor">
        <div class="contenedor_slider_principal">
            <div class="slider">
                <template x-for="(slide, index) in sliders" :key="index">
                    <div :class="['item_slider', index === posicionImagenActual ? 'imagen_activo' : 'imagen_oculto']">
                        <a :href="slide.link">
                            <img :src="slide.imagenComputadora" alt="" class="imagen_computadora" />
                            <img :src="slide.imagenMovil" alt="" class="imagen_movil" />
                        </a>
                    </div>
                </template>
            </div>

            <div class="control_botones">
                <button @click="botonRetroceder" class="boton_retroceder">
                    <img src="{{ asset('assets/ecommerce/iconos/icono_retroceder.svg') }}" alt="Retroceder" />
                </button>
                <button @click="botonSiguiente" class="boton_siguiente">
                    <img src="{{ asset('assets/ecommerce/iconos/icono_siguiente.svg') }}" alt="Siguiente" />
                </button>
            </div>

            <div class="paginacion_botones">
                <template x-for="(slide, index) in sliders" :key="index">
                    <button @click="setPosicionImagenActual(index)"
                        :class="['boton_paginacion', index === posicionImagenActual ? 'imagen_activo' : '']"></button>
                </template>
            </div>
        </div>
    </div>
    <script>
        function dataSliderPrincipal(sliders) {
            return {
                sliders: sliders,
                posicionImagenActual: 0,
                intervaloId: null,
                init() {
                    this.iniciarIntervalo();
                },
                iniciarIntervalo() {
                    this.intervaloId = setInterval(() => {
                        this.botonSiguiente();
                    }, 10000);
                },
                botonRetroceder() {
                    this.posicionImagenActual = (this.posicionImagenActual - 1 + this.sliders.length) % this.sliders.length;
                },
                botonSiguiente() {
                    this.posicionImagenActual = (this.posicionImagenActual + 1) % this.sliders.length;
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
