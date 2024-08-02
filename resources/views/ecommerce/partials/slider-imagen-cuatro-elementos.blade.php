@if (!empty($p_elementos))
    <div x-data="dataSliderPubliSeisEle1({{ json_encode($p_elementos) }})" x-init="init()" class="slider_img_tres_ele_publi_contr_2">

        <!-- SLIDER -->
        <div x-ref="slider" class="contenedor_promociones slider">
            <!-- SLIDE -->
            <template x-for="(elemento, index) in elementos" :key="index">
                <div class="slide">
                    <a :href="elemento.link">
                        <img :src="elemento.imagen" alt="" />
                    </a>
                </div>
            </template>
        </div>

        <!-- CONTROL BOTONES -->
        <button @click="handlePrev()" :disabled="currentPage === 1"
            class="control_slider_botones slider_boton_retroceder">
            <img src="{{ asset('assets/ecommerce/iconos/icono_retroceder.svg') }}" alt="Logo">
        </button>
        <button @click="handleNext()" :disabled="currentPage + itemsPorPagina > elementos.length"
            class="control_slider_botones slider_boton_siguiente">
            <img src="{{ asset('assets/ecommerce/iconos/icono_siguiente.svg') }}" alt="Logo">
        </button>

        <!-- PAGINACION BOTONES -->
        <template x-if="elementos.length > 4">
            <div class="slider_paginacion">
                <template x-for="page in totalPaginas" :key="page">
                    <button @click="setCurrentPage(page)"
                        :class="{ 'activo': currentPage === (page - 1) * itemsPorPagina + 1 }"
                        class="slider_paginacion_boton">
                    </button>
                </template>
            </div>
        </template>
    </div>

    <script>
        function dataSliderPubliSeisEle1(elementos) {
            return {
                elementos,
                cantidadElementosComputadora: 4,
                cantidadElementosTablet: 2,
                cantidadElementosMovil: 1,
                itemsPorPagina: 4,
                currentPage: 1,
                totalPaginas: Math.ceil(elementos.length / 4),

                init() {
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
                    this.totalPaginas = Math.ceil(this.elementos.length / this.itemsPorPagina);
                    this.scrollToCurrentPage();
                },

                handlePrev() {
                    this.currentPage = Math.max(this.currentPage - this.itemsPorPagina, 1);
                    this.scrollToCurrentPage();
                },

                handleNext() {
                    this.currentPage = Math.min(this.currentPage + this.itemsPorPagina, this.elementos.length);
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
