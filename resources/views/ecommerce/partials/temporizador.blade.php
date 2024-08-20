@if (!empty($p_elementos) && !empty($p_elementos->imagenes))

    <div x-data="dataTemporizador('{{ $p_elementos['fecha_fin'] }}', {{ count($p_elementos->imagenes) }})" x-init="initTemporizador()" class="partials_contenedor_temporizador">
        <div class="contenedor_fecha_hora">
            <div class="contenedor_fecha">
                <span> SOLO x HOY</span>
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

        <div class="partials_contenedor_slider_temporizador">
            <!-- Swiper -->
            <div class="swiper SwiperTemporizador-{{ $p_elementos->id }}">
                <div class="swiper-wrapper">
                    @foreach ($p_elementos->imagenes as $index => $item)
                        <div class="swiper-slide">
                            <a href="{{ $item['link'] }}">
                                <img src="{{ $item['imagen'] }}" alt="}" />
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <script>
        var swiper = new Swiper(".SwiperTemporizador-{{ $p_elementos->id }}", {
            slidesPerView: 2,
            spaceBetween: 0,
            navigation: {
                nextEl: '.SwiperTemporizador-{{ $p_elementos->id }} .swiper-button-next',
                prevEl: '.SwiperTemporizador-{{ $p_elementos->id }} .swiper-button-prev',
            },
            pagination: {
                el: '.SwiperTemporizador-{{ $p_elementos->id }} .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                1024: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                },
            }
        });

        function dataTemporizador(fecha_fin, totalImagenes) {
            const fechaFinal = new Date(fecha_fin);

            return {
                hora: 0,
                minuto: 0,
                segundo: 0,

                initTemporizador() {
                    this.intervalo();
                    setInterval(() => {
                        this.intervalo();
                    }, 1000);
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
            };
        }
    </script>
@endif
