@if (!empty($p_elementos) && !empty($p_elementos->imagenes))
    <div x-data="dataAviso{{ $p_elementos->id }}({{ count($p_elementos->imagenes) }})" x-init="initAviso()" class="contenedor_aviso">

        <!-- SLIDER -->
        <div x-ref="slider" class="contenedor_promociones">
            <!-- SLIDE -->
            @foreach ($p_elementos->imagenes as $index => $elemento)
                <div class="slide">
                    <a href="{{ $elemento['link'] }}">
                        <img src="{{ $elemento['imagen'] }}" alt="" />
                    </a>
                </div>
            @endforeach
        </div>

        <!-- CONTROL BOTONES -->
        <button @click="handlePrev()" :disabled="currentPage === 1"
            class="control_slider_botones slider_boton_retroceder">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button @click="handleNext()" :disabled="currentPage + itemsPorPagina > totalElementos"
            class="control_slider_botones slider_boton_siguiente">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <!-- PAGINACION BOTONES -->
        @if (count($p_elementos->imagenes) > 4)
            <div class="slider_paginacion">
                @for ($page = 1; $page <= ceil(count($p_elementos->imagenes) / 4); $page++)
                    <button @click="setCurrentPage({{ $page }})"
                        :class="{ 'activo': currentPage === ({{ $page }} - 1) * itemsPorPagina + 1 }"
                        class="slider_paginacion_boton">
                    </button>
                @endfor
            </div>
        @endif
    </div>

    <script>
        function dataAviso{{ $p_elementos->id }}(totalImagenes) {
            return {
                totalElementos: totalImagenes,
                cantidadElementosComputadora: 4,
                cantidadElementosTablet: 2,
                cantidadElementosMovil: 1,
                itemsPorPagina: 4,
                currentPage: 1,
                totalPaginas: Math.ceil(totalImagenes / 4),

                initAviso() {
                    this.handleResize();
                    window.addEventListener('resize', this.handleResize.bind(this));
                },

                handleResize() {
                    const windowWidth = window.innerWidth;
                    if (windowWidth > 900) {
                        this.itemsPorPagina = this.cantidadElementosComputadora;
                    } else if (windowWidth > 700) {
                        this.itemsPorPagina = this.cantidadElementosTablet;
                    } else {
                        this.itemsPorPagina = this.cantidadElementosMovil;
                    }
                    this.totalPaginas = Math.ceil(this.totalElementos / this.itemsPorPagina);
                    this.scrollToCurrentPage();
                },

                handlePrev() {
                    this.currentPage = Math.max(this.currentPage - this.itemsPorPagina, 1);
                    this.scrollToCurrentPage();
                },

                handleNext() {
                    this.currentPage = Math.min(this.currentPage + this.itemsPorPagina, this.totalElementos);
                    this.scrollToCurrentPage();
                },

                setCurrentPage(page) {
                    this.currentPage = (page - 1) * this.itemsPorPagina + 1;
                    this.scrollToCurrentPage();
                },

                scrollToCurrentPage() {
                    if (this.$refs.slider) {
                        const scrollAmount = (this.currentPage - 1) * (this.$refs.slider.clientWidth / this.itemsPorPagina);
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
