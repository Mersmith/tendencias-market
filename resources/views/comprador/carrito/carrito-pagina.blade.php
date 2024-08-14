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
                            <th>Acciones</th>
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

                                <!-- Controles de cantidad -->
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <!-- Formulario para disminuir cantidad -->
                                        <form action="{{ route('carrito.detalle.actualizar', $detalle->id) }}"
                                            method="POST" style="margin-right: 5px;">
                                            @csrf
                                            <input type="hidden" name="cantidad" value="{{ $detalle->cantidad - 1 }}">
                                            <button type="submit"
                                                {{ $detalle->cantidad <= 1 ? 'disabled' : '' }}>-</button>
                                        </form>

                                        <!-- Mostrar la cantidad actual -->
                                        <span>{{ $detalle->cantidad }}</span>

                                        <!-- Formulario para aumentar cantidad -->
                                        <form action="{{ route('carrito.detalle.actualizar', $detalle->id) }}"
                                            method="POST" style="margin-left: 5px;">
                                            @csrf
                                            <input type="hidden" name="cantidad" value="{{ $detalle->cantidad + 1 }}">
                                            <button type="submit">+</button>
                                        </form>
                                    </div>
                                </td>

                                <!-- Mostrar el precio por unidad -->
                                <td>S/. {{ number_format($detalle->precio, 2) }}</td>

                                <!-- Mostrar el total por cada ítem (cantidad * precio) -->
                                <td>S/. {{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>

                                <!-- Botón para eliminar el ítem -->
                                <td>
                                    <form action="{{ route('carrito.detalle.eliminar', $detalle->id) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit">Eliminar</button>
                                    </form>
                                </td>
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
