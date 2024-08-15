@if (!empty($p_elementos))
    <div class="partials_contenedor_carrusel">
        <!-- IMAGEN SELECCIONADA -->
        <div class="partials_contenedor_carrusel_cabecera">
            <div class="swiper swiperCabecera">
                <div class="swiper-wrapper">
                    @foreach ($p_elementos as $index => $imagen)
                        <div class="swiper-slide">
                            <img src="{{ $imagen->url }}" alt="" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <!-- SLIDER THUMBNAILS -->
        <div class="partials_contenedor_carrusel_pie">
            <div class="swiper swiperThumbnails">
                <div class="swiper-wrapper">
                    @foreach ($p_elementos as $index => $imagen)
                        <div class="swiper-slide">
                            <div class="contenedor_imagen">
                                <img src="{{ $imagen->url }}" alt="" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <script>
        // Inicializar Swiper para las miniaturas
        var swiperThumbnails = new Swiper(".swiperThumbnails", {
            direction: window.innerWidth > 1000 ? 'vertical' : 'horizontal',
            slidesPerView: 6,
            spaceBetween: 10,
            loop: false,
            pagination: {
                el: ".swiperThumbnails .swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiperThumbnails .swiper-button-next",
                prevEl: ".swiperThumbnails .swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 4,
                },
                700: {
                    slidesPerView: 6,
                }
            },
            slideToClickedSlide: true,
        });

        // Inicializar Swiper para la imagen seleccionada y vincularlo con las miniaturas
        var swiperCabecera = new Swiper(".swiperCabecera", {
            slidesPerView: 1,
            loop: true,
            navigation: {
                nextEl: ".swiperCabecera .swiper-button-next",
                prevEl: ".swiperCabecera .swiper-button-prev",
            },
            thumbs: {
                swiper: swiperThumbnails
            }
        });

        function updateActiveThumbnail() {
            // Quitar la clase activa de todos los thumbnails
            swiperThumbnails.slides.forEach(function(slide) {
                slide.classList.remove('swiper-slide-thumb-active');
            });
            // Agregar la clase activa al thumbnail correspondiente
            var activeIndex = swiperCabecera.activeIndex;
            swiperThumbnails.slides[activeIndex].classList.add('swiper-slide-thumb-active');
        }

        // Evento para actualizar el borde de la imagen seleccionada en el slider principal
        swiperCabecera.on('slideChange', updateActiveThumbnail);

        // Evento para actualizar el borde de la imagen seleccionada en los thumbnails
        swiperThumbnails.on('click', function(swiper) {
            swiperCabecera.slideTo(swiper.clickedIndex);
        });

        swiperThumbnails.on('slideChange', function() {
            var activeIndex = swiperThumbnails.activeIndex;
            swiperCabecera.slideTo(activeIndex);
        });
    </script>
@endif
