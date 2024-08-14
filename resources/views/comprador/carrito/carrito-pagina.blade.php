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
                    <tbody id="carrito-detalles">
                        @foreach ($carrito->detalle as $detalle)
                            <tr id="detalle-{{ $detalle->id }}">
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
                                        <button
                                            onclick="actualizarCantidad({{ $detalle->id }}, {{ $detalle->cantidad - 1 }})"
                                            {{ $detalle->cantidad <= 1 ? 'disabled' : '' }}>-</button>
                                        <span id="cantidad-{{ $detalle->id }}">{{ $detalle->cantidad }}</span>
                                        <button
                                            onclick="actualizarCantidad({{ $detalle->id }}, {{ $detalle->cantidad + 1 }})">+</button>
                                    </div>
                                </td>

                                <!-- Mostrar el precio por unidad -->
                                <td data-precio="{{ $detalle->precio }}">S/. {{ number_format($detalle->precio, 2) }}
                                </td>

                                <!-- Mostrar el total por cada ítem (cantidad * precio) -->
                                <td id="total-{{ $detalle->id }}">S/.
                                    {{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>

                                <!-- Botón para eliminar el ítem -->
                                <td>
                                    <button onclick="eliminarDetalle({{ $detalle->id }})">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tu carrito está vacío.</p>
            @endif
        </div>

        <div>
            <p>cantidad items: {{ $cantidadItems }} </p>
            <p>Total: S/. {{ $totalGeneral }} </p>
        </div>
    </div>

    <script>
        function actualizarCantidad(detalleId, nuevaCantidad) {
            fetch(`/carrito/detalle/${detalleId}/actualizar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        cantidad: nuevaCantidad
                    })
                })
                .then(response => {
                    console.log(response); // Añadido para inspeccionar la respuesta
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Actualiza la cantidad en el DOM
                        const cantidadElement = document.getElementById(`cantidad-${detalleId}`);
                        cantidadElement.textContent = nuevaCantidad;

                        // Actualiza el total por ítem en el DOM
                        const precioElement = document.querySelector(`#detalle-${detalleId} td[data-precio]`);
                        const precioPorUnidad = parseFloat(precioElement.getAttribute('data-precio'));
                        const nuevoTotal = nuevaCantidad * precioPorUnidad;
                        const totalElement = document.getElementById(`total-${detalleId}`);
                        totalElement.textContent = `S/. ${nuevoTotal.toFixed(2)}`;

                        // Actualiza los botones para que reflejen la nueva cantidad
                        const filaDetalle = document.getElementById(`detalle-${detalleId}`);
                        const decreaseButton = filaDetalle.querySelector('button:first-of-type');
                        const increaseButton = filaDetalle.querySelector('button:last-of-type');

                        if (decreaseButton) {
                            decreaseButton.setAttribute('onclick',
                                `actualizarCantidad(${detalleId}, ${nuevaCantidad - 1})`);
                            decreaseButton.disabled = nuevaCantidad <= 1;
                        }
                        if (increaseButton) {
                            increaseButton.setAttribute('onclick',
                                `actualizarCantidad(${detalleId}, ${nuevaCantidad + 1})`);
                        }
                    } else {
                        alert('No se pudo actualizar la cantidad.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al intentar actualizar la cantidad.');
                });
        }

        function eliminarDetalle(detalleId) {
            fetch(`/carrito/detalle/${detalleId}/eliminar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const filaDetalle = document.getElementById(`detalle-${detalleId}`);
                        filaDetalle.remove();
                    } else {
                        alert('No se pudo eliminar el producto.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al intentar eliminar el producto.');
                });
        }
    </script>
</x-ecommerce-layout>
