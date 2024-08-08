@php
    $dataEnlacesRapido = json_encode([
        [
            'id' => 1,
            'titulo' => 'Te ayudamos',
            'elementos' => [
                ['nombre' => 'Libro de reclamaciones', 'link' => 'www.google.com'],
                ['nombre' => 'Atención por WhatsApp', 'link' => 'www.google.com'],
                ['nombre' => 'Centro de ayuda', 'link' => '/informes/centro-ayuda'],
                ['nombre' => 'Tipos de entrega', 'link' => 'www.google.com'],
                ['nombre' => 'Cambios y devoluciones', 'link' => 'www.google.com'],
                ['nombre' => 'Seguimiento de mi orden', 'link' => 'www.google.com'],
                ['nombre' => 'Boletas y facturas', 'link' => 'www.google.com'],
                ['nombre' => 'Política de prevención de delitos', 'link' => 'www.google.com'],
                ['nombre' => 'Textos legales', 'link' => 'www.google.com'],
                ['nombre' => 'Inversionistas', 'link' => 'www.google.com'],
                ['nombre' => 'Canal de integridad - Integrity channel', 'link' => 'www.google.com'],
            ]
        ],
        [
            'id' => 2,
            'titulo' => 'Sé parte de falabella.com',
            'elementos' => [
                ['nombre' => 'Vende con nosotros', 'link' => '/informes/vende-con-nosotros'],
                ['nombre' => 'Trabaja con nosotros', 'link' => 'www.google.com'],
                ['nombre' => 'Venta empresa', 'link' => '/informes/venta-empresa'],
                ['nombre' => 'Tareas', 'link' => '/dashboard/tareas'],
            ]
        ],
        [
            'id' => 3,
            'titulo' => 'Únete a nuestros programas',
            'elementos' => [
                ['nombre' => 'Novios Falabella', 'link' => 'www.google.com'],
                ['nombre' => 'CMR Puntos', 'link' => 'www.google.com'],
                ['nombre' => 'Pide tu CMR', 'link' => 'www.google.com'],
                ['nombre' => 'Cyber WOW 2023', 'link' => 'www.google.com'],
                ['nombre' => 'Hot Sale', 'link' => 'www.google.com'],
                ['nombre' => 'Black Friday', 'link' => 'www.google.com'],
            ]
        ],
        [
            'id' => 4,
            'titulo' => 'Nuestras empresas',
            'elementos' => [
                ['nombre' => 'Banco Falabella', 'link' => 'www.google.com'],
                ['nombre' => 'Seguros Falabella', 'link' => 'www.google.com'],
                ['nombre' => 'Saga Falabella', 'link' => 'www.google.com'],
                ['nombre' => 'Sodimac', 'link' => 'www.google.com'],
                ['nombre' => 'Tottus', 'link' => 'www.google.com'],
                ['nombre' => 'Linio', 'link' => 'www.google.com'],
                ['nombre' => 'Tottus app', 'link' => 'www.google.com'],
                ['nombre' => 'Nuestra empresa', 'link' => 'www.google.com'],
            ]
        ],
    ]);
@endphp

<div x-data="dataPiePagEnla({{ $dataEnlacesRapido }})">
    <div class="contenedor_enlaces_rapidos">
        <div class="g_centrar_contenido_pagina">
            <div class="g_contenido_pagina">
                <div class="columna_12">
                    <div class="grid_contenedor_items">
                        <!-- CONTENEDOR ITEM -->
                        <template x-for="(data, index) in dataEnlacesRapido" :key="index">
                            <div @click="toggleAccordion(index)" class="contenedor_item">
                                <!-- CONTENEDOR TITULO -->
                                <div class="contenedor_titulo">
                                    <p x-text="data.titulo"></p>

                                    <!-- CONTENEDOR CONTROL -->
                                    <span class="contenedor_control" x-text="itemIndex === index ? '-' : '+'"></span>
                                </div>

                                <!-- CONTENEDOR ACORDEON -->
                                <ul class="contenedor_acordeon" :class="{'mostrar': itemIndex === index}">
                                    <template x-for="(elemento, elementoIndex) in data.elementos" :key="elementoIndex">
                                        <li>
                                            <a :href="elemento.link" x-text="elemento.nombre"></a>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function dataPiePagEnla(dataEnlacesRapido) {
        return {
            dataEnlacesRapido: dataEnlacesRapido,
            itemIndex: null,
            toggleAccordion(index) {
                if (this.itemIndex === index) {
                    this.itemIndex = null;
                } else {
                    this.itemIndex = index;
                }
            }
        }
    }
</script>