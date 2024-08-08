@if (!empty($p_elementos) && !empty($p_elementos->imagenes))

    <div x-data="dataTemporizador('{{ $p_elementos['fecha_fin'] }}', {{ count($p_elementos->imagenes) }})" x-init="initTemporizador()" class="partials_contenedor_temporizador">
        <div class="contenedor_fecha_hora">
            <div class="contenedor_fecha">
                <span> SOLO x HOY</span>

                <img src="{{ asset('assets/ecommerce/iconos/icono_reloj.svg') }}" alt="Logo" />
            </div>

            <div class="contenedor_hora">
                <template x-for="digito in padTwoDigits(hora)">
                    <p x-text="digito"></p>
                </template>
                <span>:</span>
                <template x-for="digito in padTwoDigits(minuto)">
                    <p x-text="digito"></p>
                </template>
                <span>:</span>
                <template x-for="digito in padTwoDigits(segundo)">
                    <p x-text="digito"></p>
                </template>
            </div>
        </div>

        <div style="position: relative; width: 100%;">
            <!-- SLIDER -->
            <div x-ref="slider" class="contenedor_slide">
                @foreach ($p_elementos->imagenes as $index => $item)
                    <div class="item_slide">
                        <a href="{{ $item['link'] }}">
                            <img src="{{ $item['imagen'] }}" alt="Promoción {{ $index + 1 }}" />
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
    </div>

    <script>
        function dataTemporizador(fecha_fin, totalImagenes) {
            const fechaFinal = new Date(fecha_fin);

            return {
                hora: 0,
                minuto: 0,
                segundo: 0,

                totalElementos: totalImagenes,
                cantidadElementosComputadora: 2,
                //cantidadElementosTablet: 2,
                cantidadElementosMovil: 1,
                itemsPorPagina: 2,
                paginaActual: 1,
                totalPaginas: Math.ceil(totalImagenes / 2),

                initTemporizador() {
                    this.intervalo();
                    setInterval(() => {
                        this.intervalo();
                    }, 1000);

                    this.anchoPantalla();
                    window.addEventListener('resize', this.anchoPantalla.bind(this));

                },

                intervalo() {
                    const ahora = new Date();
                    const tiempoRestante = Math.floor((fechaFinal - ahora) / 1000);

                    if (tiempoRestante > 0) {
                        this.hora = Math.floor(tiempoRestante / 3600) % 24;
                        this.minuto = Math.floor(tiempoRestante / 60) % 60;
                        this.segundo = tiempoRestante % 60;
                    }
                },

                padTwoDigits(valor) {
                    return valor.toString().padStart(2, '0').split('');
                },

                anchoPantalla() {
                    const windowWidth = window.innerWidth;
                    if (windowWidth > 1000) {
                        this.itemsPorPagina = this.cantidadElementosComputadora;
                    } /*else if (windowWidth > 700) {
                        this.itemsPorPagina = this.cantidadElementosTablet;
                    } */else {
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
