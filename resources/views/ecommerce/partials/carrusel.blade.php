@if (!empty($p_elementos))

    <div x-data="dataCarrusel({{ count($p_elementos) }})" x-init="initSliderProductos()" class="partials_contenedor_carrusel">
        <div class="partials_contenedor_carrusel_cabecera">
            @foreach ($p_elementos as $index => $imagen)
                <div>
                    <div
                        x-bind:class="posicionImagenActual === @json($index) ? 'imagen_activo' : 'imagen_oculto'">
                        <img src="{{ $imagen->url }}" alt="" />
                    </div>
                </div>
            @endforeach
            <button @click="botonRetrocederImagen">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button @click="botonSiguienteImagen">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

        <div class="partials_contenedor_carrusel_pie">

            <!-- SLIDER -->
            <div x-ref="slider" class="contenedor_slide">
                @foreach ($p_elementos as $index => $imagen)
                    <div class="item_slide">
                        <div class="contenedor_imagen" @click="setPosicionImagenActual({{ $index }})">
                            <img src="{{ $imagen->url }}" alt=""
                                :class="{ 'imagen_elegida': posicionImagenActual === {{ $index }} }" />
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- CONTROL BOTONES -->
            <div class="control_botones" x-show="totalPaginas > 1">
                <button @click="botonRetroceder()" :disabled="paginaActual === 1" class="boton_retroceder">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button @click="botonSiguiente()" :disabled="paginaActual + itemsPorPagina > totalElementos"
                    class="boton_siguiente">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <!-- PAGINACION BOTONES -->
            <div class="paginacion_botones" x-show="totalPaginas > 1">
                <template x-for="itemPagina in totalPaginas" :key="itemPagina">
                    <button @click="setPaginaActual(itemPagina)"
                        :class="{ 'boton_activo': paginaActual === (itemPagina - 1) * itemsPorPagina + 1 }"></button>
                </template>
            </div>
        </div>
    </div>

    <script>
        function dataCarrusel(totalImagenes) {
            return {
                posicionImagenActual: 0,
                totalElementos: totalImagenes,
                cantidadElementosComputadora: 6,
                cantidadElementosTablet: 4,
                cantidadElementosMovil: 5,
                itemsPorPagina: 6,
                paginaActual: 1,
                totalPaginas: Math.ceil(totalImagenes / 6),

                initSliderProductos() {
                    this.anchoPantalla();
                    window.addEventListener('resize', this.anchoPantalla.bind(this));
                },

                anchoPantalla() {
                    const windowWidth = window.innerWidth;
                    if (windowWidth > 1000) {
                        this.itemsPorPagina = this.cantidadElementosComputadora;
                    } else if (windowWidth > 700) {
                        this.itemsPorPagina = this.cantidadElementosTablet;
                    } else {
                        this.itemsPorPagina = this.cantidadElementosMovil;
                    }
                    this.totalPaginas = Math.ceil(this.totalElementos / this.itemsPorPagina);
                    this.scrollPaginaActual();
                },

                setPosicionImagenActual(index) {
                    this.posicionImagenActual = index;
                },

                botonRetrocederImagen() {
                    if (this.posicionImagenActual === 0) {
                        this.posicionImagenActual = this.totalElementos - 1; // Se mueve a la última imagen
                    } else {
                        this.posicionImagenActual = this.posicionImagenActual - 1;
                    }
                },

                botonSiguienteImagen() {
                    if (this.posicionImagenActual === this.totalElementos - 1) {
                        this.posicionImagenActual = 0; // Se mueve a la primera imagen
                    } else {
                        this.posicionImagenActual = this.posicionImagenActual + 1;
                    }
                },

                botonRetroceder() {
                    this.paginaActual = Math.max(this.paginaActual - this.itemsPorPagina, 1);
                    this.scrollPaginaActual();
                },

                botonSiguiente() {
                    this.paginaActual = Math.min(this.paginaActual + this.itemsPorPagina, this.totalElementos);
                    this.scrollPaginaActual();
                },

                setPaginaActual(itemPagina) {
                    this.paginaActual = (itemPagina - 1) * this.itemsPorPagina + 1;
                    this.scrollPaginaActual();
                },

                scrollPaginaActual() {
                    if (this.$refs.slider) {
                        const scrollAmount = (this.paginaActual - 1) * (this.$refs.slider.clientWidth / this
                            .itemsPorPagina);
                        this.$refs.slider.scrollTo({
                            left: scrollAmount,
                            behavior: 'smooth'
                        });
                    }
                },

            };
        }
    </script>
@endif
