<!-- slider-productos-seis-elementos.blade.php -->
<div x-data="dataSliderProductos({{ count($p_elementos) }})" x-init="initSliderProductos()" class="partials_contenedor_slider_productos">

    <!-- SLIDER -->
    <div x-ref="slider" class="contenedor_slide">
        @foreach ($p_elementos as $index => $producto)
            <div class="item_slide">
                <a href="{{ $producto['producto_url'] }}">
                    <div class="contenedor_imagen">
                        <img src="{{ $producto['imagen']['url'] }}" alt="Promoción {{ $index + 1 }}">
                        @if ($producto['descuento'])
                            <span>{{ $producto['descuento'] }}%</span>
                        @endif
                    </div>
                </a>
                <div class="marca">{{ $producto['marca'] }}</div>
                <div class="titulo">{{ $producto['producto_nombre'] }}</div>
                @if (isset($producto['card']) && $producto['card'])
                    <div class="tarjeta">
                        <img src="{{ asset('assets/ecommerce/imagenes/tarjetas/cmrIcon.svg') }}" alt="Tarjeta">
                    </div>
                @endif
                @if ($producto['precio_oferta'])
                    <div class="precio_oferta">
                        <span>{{ $producto['simbolo'] }}</span>
                        <span>{{ $producto['precio_oferta'] }}</span>
                    </div>
                @endif
                @if ($producto['precio_venta'])
                    <div class="precio_real">
                        <span>{{ $producto['simbolo'] }}</span>
                        <span>{{ $producto['precio_venta'] }}</span>
                    </div>
                @endif
                @if ($producto['precio_antiguo'])
                    <div class="precio_antiguo">
                        <span>{{ $producto['simbolo'] }}</span>
                        <span>{{ $producto['precio_antiguo'] }}</span>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- CONTROL BOTONES -->
    <button @click="handlePrev()" :disabled="currentPage === 1" class="control_slider_botones slider_boton_retroceder">
        <img src="{{ asset('assets/ecommerce/iconos/icono_retroceder.svg') }}" alt="Logo">
    </button>
    <button @click="handleNext()" :disabled="currentPage + itemsPorPagina > totalElementos"
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
    function dataSliderProductos(totalProductos) {
        return {
            totalElementos: totalProductos,
            cantidadElementosComputadora: 6,
            cantidadElementosTablet: 2,
            cantidadElementosMovil: 1,
            itemsPorPagina: 6,
            currentPage: 1,
            totalPaginas: Math.ceil(totalProductos / 6),

            initSliderProductos() {
                this.handleResize();
                window.addEventListener('resize', this.handleResize.bind(this));
            },

            handleResize() {
                const windowWidth = window.innerWidth;
                if (windowWidth > 1000) {
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
