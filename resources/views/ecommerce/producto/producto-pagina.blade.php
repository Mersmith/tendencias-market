<x-ecommerce-layout>
    <div>
        <div>
            <style>
                .dividir {
                    display: flex;
                    width: 100%;
                }

                .dividir_1 {
                    width: 30%;
                    flex-direction: column;
                }

                .dividir_2 {
                    width: 70%;
                }

                select {
                    margin-bottom: 10px;
                }
            </style>

            <div class="dividir">
                <div class="dividir_1">

                    @foreach ($imagenes as $index => $imagen)
                        <img src="{{ $imagen->url }}" alt="Promoción {{ $index + 1 }}">
                    @endforeach

                </div>

                <div class="dividir_2">

                    <h2>{{ $producto->nombre }}</h2>
                    <p>{{ $producto->descripcion }}</p>
                    <p><strong>Precio:</strong>
                        {{ $producto->simbolo }}{{ $producto->precio }}</p>
                    @if ($producto->porcentaje_descuento)
                        <p><strong>Descuento:</strong> {{ $producto->porcentaje_descuento }}% hasta
                            {{ \Carbon\Carbon::parse($producto->descuento_fecha_fin)->format('d/m/Y H:i') }}
                        </p>
                    @endif
                </div>

            </div>

        </div>

    </div>
</x-ecommerce-layout>
