<!-- slider-elementos-seis-elementos.blade.php -->
<div x-data="dataSliderPubliSeisEle({{ json_encode($p_elementos) }})" x-init="init()" class="slider_img_tres_ele_publi_contr">

    <!-- SLIDER -->
    <div x-ref="slider" class="contenedor_promociones slider">
        <!-- SLIDE -->
        <template x-for="(elemento, index) in elementos" :key="index">
            <div :class="{ 'item_50': elemento.width === 50, 'item_25': elemento.width === 25 }" class="slide">
                <a :href="elemento.link">
                    <img :src="elemento.imagenComputadora" alt="" class="imagen_computadora" />
                    <img :src="elemento.imagenMovil" alt="" class="imagen_movil" />
                </a>
            </div>
        </template>
    </div>

    <!-- CONTROL BOTONES -->
    <button @click="handlePrev()" :disabled="currentPage === 1" class="control_slider_botones slider_boton_retroceder">
        <img src="{{ asset('assets/ecommerce/iconos/icono_retroceder.svg') }}" alt="Logo">
    </button>
    <button @click="handleNext()" :disabled="currentPage + itemsPorPagina > elementos.length"
        class="control_slider_botones slider_boton_siguiente">
        <img src="{{ asset('assets/ecommerce/iconos/icono_siguiente.svg') }}" alt="Logo">
    </button>

    <!-- PAGINACION BOTONES -->
    <div class="slider_paginacion">
        <template x-for="page in totalPaginas">
            <button @click="setCurrentPage(page)" :class="{ 'activo': currentPage === (page - 1) * itemsPorPagina + 1 }"
                class="slider_paginacion_boton">
            </button>
        </template>
    </div>
</div>

<script>
    function dataSliderPubliSeisEle(elementos) {
        return {
            elementos,
            cantidadElementosComputadora: 3,
            cantidadElementosTablet: 2,
            cantidadElementosMovil: 1,
            itemsPorPagina: 3,
            currentPage: 1,
            totalPaginas: Math.ceil(elementos.length / 3),

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
