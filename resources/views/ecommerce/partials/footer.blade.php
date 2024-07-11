<div x-data="baseComponent()">
    <div class="footer">
        <div class="centrar_contenido_pagina">
            <div class="contenido_pagina">
                <div class="columna_12">
                    <!-- CONTENEDOR REDES - TERMINOS -->
                    <div class="contenedor_redes_terminos">
                        <!-- CONTENEDOR REDES -->
                        <div class="contenedor_redes">
                            <template x-for="data in dataRedesSociales" :key="data.id">
                                <a :href="data.link"></a>
                            </template>
                        </div>

                        <!-- CONTENEDOR TERMINOS -->
                        <div class="contenedor_terminos">
                            <template x-for="data in dataTerminos" :key="data.id">
                                <a :href="data.link" x-text="data.nombre"></a>
                            </template>
                        </div>
                    </div>

                    <!-- CONTENEDOR DERECHOS -->
                    <div class="contenedor_derechos">
                        <p>© TODOS LOS DERECHOS RESERVADOS</p>
                        <span>Falabella.com S.A.C. Av. Paseo de la República 3220, San Isidro, Perú</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function baseComponent(items) {
        return {
            dataRedesSociales: [{
                    id: 1,
                    nombre: "facebook",
                    icono: "/iconos/redes-sociales/facebook.svg",
                    link: "www.google.com"
                },
                {
                    id: 2,
                    nombre: "instagram",
                    icono: "/iconos/redes-sociales/instagram.svg",
                    link: "www.google.com"
                }
            ],
            dataTerminos: [{
                    id: 1,
                    nombre: "Términos y condiciones",
                    link: "www.google.com"
                },
                {
                    id: 2,
                    nombre: "Política de cookies",
                    link: "www.google.com"
                },
                {
                    id: 3,
                    nombre: "Política de privacidad",
                    link: "www.google.com"
                }
            ]
        }
    }
</script>
