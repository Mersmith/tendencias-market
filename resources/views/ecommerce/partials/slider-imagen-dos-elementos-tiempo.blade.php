<div x-data="sliderImagenDosElementosTiempo('{{ $dataSliderImagenDosElementosTiempo['fecha_finaliza'] }}')">

    {{-- FECHA Y HORA --}}
    <div class="slider_imagen_dos_elementos_tiempo">
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

        {{-- SLIDER --}}
        <div class="contenedor_promociones slider">
            @foreach ($dataSliderImagenDosElementosTiempo['data'] as $index => $item)
                <div class="slide">
                    <a href="{{ $item['link'] }}">
                        {{-- IMAGENES --}}
                        <img src="{{ $item['imagen'] }}" alt="Promoción {{ $index + 1 }}" />
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    function sliderImagenDosElementosTiempo(fechaFinaliza) {
        const fechaFinal = new Date(fechaFinaliza);

        return {
            hora: 0,
            minuto: 0,
            segundo: 0,

            padTwoDigits(valor) {
                return valor.toString().padStart(2, '0').split('');
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

            init() {
                this.intervalo();
                setInterval(() => {
                    this.intervalo();
                }, 1000);
            }
        };
    }
</script>