@if (!empty($p_elementos) && !empty($p_elementos->imagenes))
    <div x-data="dataGrid{{ $p_elementos->id }}({{ count($p_elementos->imagenes) }})" x-init="initGrid()" class="partials_contenedor_grid">

        <!-- SLIDER -->
        <div x-ref="slider" class="contenedor_slide">
            @foreach ($p_elementos->imagenes as $index => $elemento)
                <div
                    class="item_slide {{ $elemento['width'] === 50 ? 'item_50' : ($elemento['width'] === 25 ? 'item_25' : '') }}">
                    <a href="{{ $elemento['link'] }}">
                        <img src="{{ $elemento['imagenComputadora'] }}" alt="" class="imagen_computadora" />
                        <img src="{{ $elemento['imagenMovil'] }}" alt="" class="imagen_movil" />
                    </a>
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

    <script>
        function dataGrid{{ $p_elementos->id }}(totalImagenes) {
            return {
                totalElementos: totalImagenes,
                cantidadElementosComputadora: 3,
                cantidadElementosTablet: 2,
                cantidadElementosMovil: 1,
                itemsPorPagina: 3,
                paginaActual: 1,
                totalPaginas: Math.ceil(totalImagenes / 3),

                initGrid() {
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
                }
            };
        }
    </script>
@endif
