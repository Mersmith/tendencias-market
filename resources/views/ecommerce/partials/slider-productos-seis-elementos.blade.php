<!-- slider-productos-seis-elementos.blade.php -->
<div x-data="sliderProductosSeisElementos({{ json_encode($productos) }})" x-init="init()" class="contenedor_slider_producto">

    <!-- SLIDER -->
    <div x-ref="slider" class="slider">
        <!-- SLIDE -->
        <template x-for="(producto, index) in productos" :key="index">
            <div class="slide">
                <a :href="producto.url">
                    <div class="contenedor_imagen">
                        <img :src="producto.image" :alt="'Promoción ' + (index + 1)">
                        <template x-if="producto.discount">
                            <span x-text="producto.discount"></span>
                        </template>
                    </div>
                </a>
                <div class="marca" x-text="producto.brand"></div>
                <div class="titulo" x-text="producto.displayName"></div>
                <template x-if="producto.card">
                    <div class="tarjeta">
                        <img src="{{ asset('assets/ecommerce/imagenes/tarjetas/cmrIcon.svg') }}">
                    </div>
                </template>
                <template x-if="producto.ofertaPrice">
                    <div class="precio_oferta">
                        <span x-text="producto.symbol"></span>
                        <span x-text="producto.ofertaPrice"></span>
                    </div>
                </template>
                <template x-if="producto.originalPrice">
                    <div class="precio_real">
                        <span x-text="producto.symbol"></span>
                        <span x-text="producto.originalPrice"></span>
                    </div>
                </template>
                <template x-if="producto.oldPrice">
                    <div class="precio_antiguo">
                        <span x-text="producto.symbol"></span>
                        <span x-text="producto.oldPrice"></span>
                    </div>
                </template>
            </div>
        </template>
    </div>

    <!-- CONTROL BOTONES -->
    <button @click="handlePrev()" :disabled="currentPage === 1" class="control_botones boton_retroceder">
        <img src="{{ asset('assets/ecommerce/iconos/icono_retroceder.svg') }}" alt="Logo">
    </button>
    <button @click="handleNext()" :disabled="currentPage + itemsPorPagina > productos.length"
        class="control_botones boton_siguiente">
        <img src="{{ asset('assets/ecommerce/iconos/icono_siguiente.svg') }}" alt="Logo">
    </button>

    <!-- PAGINACION BOTONES -->
    <div class="paginacion_botones">
        <template x-for="page in totalPaginas">
            <button @click="setCurrentPage(page)" :class="{ 'activo': currentPage === (page - 1) * itemsPorPagina + 1 }"
                class="boton_paginacion">
            </button>
        </template>
    </div>
</div>

<script>
    function sliderProductosSeisElementos(productos) {
        return {
            productos,
            cantidadElementosComputadora: 6,
            cantidadElementosTablet: 2,
            cantidadElementosMovil: 1,
            itemsPorPagina: 6,
            currentPage: 1,
            totalPaginas: Math.ceil(productos.length / 6),

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
                this.totalPaginas = Math.ceil(this.productos.length / this.itemsPorPagina);
                this.scrollToCurrentPage();
            },

            handlePrev() {
                this.currentPage = Math.max(this.currentPage - this.itemsPorPagina, 1);
                this.scrollToCurrentPage();
            },

            handleNext() {
                this.currentPage = Math.min(this.currentPage + this.itemsPorPagina, this.productos.length);
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