<div x-data="dataPiePagCatego({{ json_encode($p_elementos->enlaces) }})" x-init="init()">
    <div class="pie_pagina_categorias">
        <div class="centrar_contenido_pagina">
            <div class="contenido_pagina">
                <div class="columna_12">
                    @include('ecommerce.partials.titulo-icono', [
                        'p_contenido' => 'Encuentra todo en un solo lugar',
                        'p_alineacion' => 'center',
                        'p_color' => '#4a4a4a',
                    ])

                    {{-- CONTENEDOR DE CATEGORÍAS --}}
                    <div class="contenedor_marcas">
                        <template x-for="(categoria, index) in elementosAMostrar" :key="index">
                            <div>
                                <p x-text="categoria.titulo"></p>
                                <ul>
                                    <template x-for="(elemento, elementoIndex) in categoria.elementos"
                                        :key="elementoIndex">
                                        <li><a :href="elemento.link" x-text="elemento.nombre"></a></li>
                                    </template>
                                </ul>
                            </div>
                        </template>
                    </div>

                    {{-- CONTENEDOR MOSTRAR --}}
                    <div class="contenedor_control_mostrar" x-show="cantidadElementos == 2">
                        <p @click="mostrarMas" x-show="elementosAMostrar.length !== categorias.length">Mostrar más <span
                                class="invertido">^</span></p>
                        <p @click="mostrarMenos" x-show="elementosAMostrar.length === categorias.length">Mostrar menos
                            <span class="normal">^</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function dataPiePagCatego(categorias) {
        return {
            categorias: categorias,
            cantidadElementos: 4,
            elementosAMostrar: [],

            init() {
                this.handleResize();
                window.addEventListener('resize', () => this.handleResize());
            },

            handleResize() {
                const windowWidth = window.innerWidth;
                this.cantidadElementos = windowWidth > 900 ? 4 : 2;
                this.elementosAMostrar = this.categorias.slice(0, this.cantidadElementos);
            },

            mostrarMas() {
                this.elementosAMostrar = this.categorias;
            },

            mostrarMenos() {
                this.elementosAMostrar = this.categorias.slice(0, 2);
            }
        };
    }
</script>
