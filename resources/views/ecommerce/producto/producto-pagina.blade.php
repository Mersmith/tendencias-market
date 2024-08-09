<x-ecommerce-layout>
    <div class="contenedor_pagina_producto">
        <div class="centrar">

            <div class="contenedor_bloque">

                <div class="contendor_migaja">
                    <p> Home </p>
                </div>


                <div class="contenedor_informacion_producto">

                    <div x-data="carousel()" class="contenedor_imagenes_producto">
                        <!-- Imagen seleccionada -->
                        <div class="imagen-seleccionada">
                            <img :src="selectedImage.url" alt="Imagen seleccionada" class="w-full">
                        </div>
                    
                        <!-- Controles de navegación -->
                        <div class="controles-navegacion mt-4 flex justify-between">
                            <button @click="prevImage()" class="btn-anterior">
                                &#10094; Anterior
                            </button>
                            <button @click="nextImage()" class="btn-siguiente">
                                Siguiente &#10095;
                            </button>
                        </div>
                    
                        <!-- Previsualización de imágenes -->
                        <div class="previsualizacion-imagenes mt-4 flex space-x-2 overflow-x-auto">
                            @foreach ($imagenes as $index => $imagen)
                                <img @click="selectImage({{ $imagen->id }})"
                                     :class="selectedImage.id === @json( $imagen->id) ? 'borde_rojo' : 'borde_verde'"
                                     src="{{ $imagen->url }}" alt="Promoción {{ $index + 1 }}"
                                     class="w-24 cursor-pointer transition-border duration-200">
                            @endforeach
                        </div>
                    </div>                    

                    <div class="contendor_detalle_producto">
                        <div>

                            <h2>{{ $producto->nombre }}</h2>

                            <div class="contenedor_precios">
                                <p><strong>Precio:</strong>
                                    {{ $producto->simbolo }}{{ $producto->precio }}</p>
                                @if ($producto->porcentaje_descuento)
                                    <p><strong>Descuento:</strong> {{ $producto->porcentaje_descuento }}% hasta
                                        {{ \Carbon\Carbon::parse($producto->descuento_fecha_fin)->format('d/m/Y H:i') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <hr>

                        @livewire('ecommerce.producto.agregar-carrito-livewire', [
                            'tipo_variacion' => $tipo_variacion,
                            'variacion_agrupada' => $variacion_agrupada,
                            'color_seleccionado' => $color_seleccionado,
                            'talla_seleccionado' => $talla_seleccionado,
                        ])
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script>
        function carousel() {
            return {
                images: @json($imagenes),
                selectedImage: @json($imagenes->first()), // La primera imagen seleccionada por defecto
    
                selectImage(id) {
                    this.selectedImage = this.images.find(image => image.id === id); // Selecciona la imagen por ID
                },
    
                nextImage() {
                    const currentIndex = this.images.indexOf(this.selectedImage);
                    const nextIndex = (currentIndex + 1) % this.images.length;
                    this.selectedImage = this.images[nextIndex];
                },
    
                prevImage() {
                    const currentIndex = this.images.indexOf(this.selectedImage);
                    const prevIndex = (currentIndex - 1 + this.images.length) % this.images.length;
                    this.selectedImage = this.images[prevIndex];
                }
            }
        }
    </script>
    
    

</x-ecommerce-layout>
