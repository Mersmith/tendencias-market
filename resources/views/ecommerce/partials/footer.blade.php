<div x-data="dataFooter()">
    <div class="footer" :style="{ backgroundColor: backgroundColor }">
        <div class="g_centrar_contenido_pagina">
            <div class="g_contenido_pagina">
                <div class="columna_12">
                    <!-- CONTENEDOR REDES - TERMINOS -->
                    <div class="contenedor_redes_terminos">
                        <!-- CONTENEDOR REDES -->
                        <div class="contenedor_redes">
                            <template x-for="data in dataRedesSociales">
                                <a :href="data.link" x-html="data.nombre"></a>
                            </template>
                        </div>

                        <!-- CONTENEDOR TERMINOS -->
                        <div class="contenedor_terminos">
                            <template x-for="data in dataTerminos">
                                <a :href="data.link" x-text="data.nombre"></a>
                            </template>
                        </div>
                    </div>

                    <!-- CONTENEDOR DERECHOS -->
                    <div class="contenedor_derechos">
                        <p x-text="derechos"></p>
                        <span x-text="direccion"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function dataFooter() {
        return {
            dataRedesSociales: [],
            dataTerminos: [],
            derechos: '',
            direccion: '',
            backgroundColor: '',
            async init() {
                const response = await fetch(`{{ route('erp.plantilla.footer.json.get') }}`);
                const footer = await response.json();
                this.dataRedesSociales = footer.redes_sociales;
                this.dataTerminos = footer.terminos;
                this.derechos = footer.derechos;
                this.direccion = footer.direccion;
                this.backgroundColor = footer.background_color;
            }
        }
    }
</script>
