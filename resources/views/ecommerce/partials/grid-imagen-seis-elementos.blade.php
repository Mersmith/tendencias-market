<div x-data="gridComponent({{ json_encode($dataGridImagenSeisElementos_2) }})">
    <!-- CONTENEDOR GRID -->
    <div class="contenedor_grid_imagen_seis_elementos">
        <!-- LINK -->
        <template x-for="(item, index) in visibleItems" :key="item.id">
            <a :href="item.link">
                <!-- IMAGENES -->
                <img :src="item.imagen" :alt="item.nombre" />
                <p x-text="item.nombre"></p>
            </a>
        </template>
    </div>

    <!-- CONTENEDOR CONTROL -->
    <div class="contenedor_control_grid_imagen_seis_elementos" x-show="items.length > 6">
        <p @click="toggleMostrarMas" x-show="!mostrarMas">Mostrar más <span class="invertido">^</span></p>
        <p @click="toggleMostrarMas" x-show="mostrarMas">Mostrar menos <span class="normal">^</span></p>
    </div>
</div>

<script>
    function gridComponent(items) {
        return {
            items: items,
            mostrarMas: false,
            get visibleItems() {
                return this.mostrarMas ? this.items : this.items.slice(0, 6);
            },
            toggleMostrarMas() {
                this.mostrarMas = !this.mostrarMas;
            }
        }
    }
</script>