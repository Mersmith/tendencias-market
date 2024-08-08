@if (!empty($p_elementos))
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
        function dataSliderProductos(totalProductos) {
            return {
                totalElementos: totalProductos,
                cantidadElementosComputadora: 6,
                cantidadElementosTablet: 2,
                cantidadElementosMovil: 1,
                itemsPorPagina: 6,
                paginaActual: 1,
                totalPaginas: Math.ceil(totalProductos / 6),

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
