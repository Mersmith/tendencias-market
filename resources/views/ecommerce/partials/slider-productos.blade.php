@if (!empty($p_elementos) && !empty($p_elementos['productos']))

    @include('ecommerce.partials.titulo', [
        'p_contenido' => $p_elementos['slider']['titulo'],
        'p_alineacion' => 'left',
        'p_color' => '#000000',
    ])

    <div class="partials_contenedor_slider_productos">
        <!-- Swiper -->
        <div class="swiper SwiperSliderProducto">
            <div class="swiper-wrapper">
                @foreach ($p_elementos['productos'] as $index => $producto)
                    <div class="swiper-slide">
                        <div>
                            <a href="{{ $producto->producto_url }}">
                                <div class="contenedor_imagen">
                                    <img src="{{ $producto->imagen_url }}" alt="Promoción {{ $index + 1 }}">
                                    @if ($producto->porcentaje_descuento)
                                        <span>{{ $producto->porcentaje_descuento }}%</span>
                                    @endif
                                </div>
                            </a>
                            <div class="marca">{{ $producto->marca_nombre }}</div>
                            <div class="titulo">{{ $producto->producto_nombre }}</div>

                            @if ($producto->precio_oferta)
                                <div class="precio_oferta">
                                    <span>S/.</span>
                                    <span>{{ $producto->precio_oferta }}</span>
                                </div>
                            @endif
                            @if ($producto->precio_normal)
                                <div class="precio_real">
                                    <span>S/.</span>
                                    <span>{{ $producto->precio_normal }}</span>
                                </div>
                            @endif
                            @if ($producto->precio_antiguo)
                                <div class="precio_antiguo">
                                    <span>S/.</span>
                                    <span>{{ $producto->precio_antiguo }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <script>
        var swiper = new Swiper('.SwiperSliderProducto', {
            slidesPerView: 6,
            spaceBetween: 10,
            navigation: {
                nextEl: '.SwiperSliderProducto .swiper-button-next',
                prevEl: '.SwiperSliderProducto .swiper-button-prev',
            },
            pagination: {
                el: '.SwiperSliderProducto .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                1024: {
                    slidesPerView: 6,
                },
                700: {
                    slidesPerView: 4,
                },
                0: {
                    slidesPerView: 2,
                }
            }
        });
    </script>

@endif
