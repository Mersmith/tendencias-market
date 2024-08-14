<x-ecommerce-layout>
    <div>
        <h2>Carrito</h2>

        <div>
            <h1>Carrito de Compras</h1>

            @if ($carrito && $carrito->detalle->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Variación</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carrito->detalle as $detalle)
                            <tr>
                                <!-- Mostrar el nombre del producto -->
                                <td>{{ $detalle->variacion->producto->nombre }}</td>

                                <!-- Mostrar los detalles de la variación (por ejemplo, color y talla) -->
                                <td>
                                    @if ($detalle->variacion->color)
                                        Color: {{ $detalle->variacion->color->nombre }} <br>
                                    @endif
                                    @if ($detalle->variacion->talla)
                                        Talla: {{ $detalle->variacion->talla->nombre }}
                                    @endif
                                </td>

                                <!-- Mostrar la cantidad -->
                                <td>{{ $detalle->cantidad }}</td>

                                <!-- Mostrar el precio por unidad -->
                                <td>S/. {{ number_format($detalle->precio, 2) }}</td>

                                <!-- Mostrar el total por cada ítem (cantidad * precio) -->
                                <td>S/. {{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tu carrito está vacío.</p>
            @endif
        </div>

    </div>
</x-ecommerce-layout>
