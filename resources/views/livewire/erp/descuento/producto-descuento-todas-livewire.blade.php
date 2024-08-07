@section('tituloPagina', 'Productos con Descuentos')

@section('anchoPantalla', '100%')

<div>
    <!-- CABECERA TITULO PAGINA -->
    <div class="g_panel cabecera_titulo_pagina">
        <!-- TITULO -->
        <h2>Productos con Descuentos</h2>

        <!-- BOTONES -->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.producto-descuento.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        @if ($productos->count())
            <!-- TABLA CABECERA -->
            <div class="tabla_cabecera">
                <!-- TABLA CABECERA BOTONES -->
                <div class="tabla_cabecera_botones">
                    <button>
                        PDF <i class="fa-solid fa-file-pdf"></i>
                    </button>

                    <button>
                        EXCEL <i class="fa-regular fa-file-excel"></i>
                    </button>
                </div>

                <!-- TABLA CABECERA BUSCAR -->
                <div class="tabla_cabecera_buscar">
                    <form action="">
                        <input type="text" wire:model.live.debounce.1300ms="buscarProducto" id="buscarProducto"
                            name="buscarProducto" placeholder="Buscar...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                </div>
            </div>

            <!-- TABLA CONTENIDO -->
            <div class="tabla_contenido">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Producto</th>
                                @foreach ($listasPrecios as $listaPrecio)
                                    <th>{{ $listaPrecio->nombre }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">ID: {{ $producto->id }} - {{ $producto->nombre }}</td>
                                    @foreach ($listasPrecios as $listaPrecio)
                                        @php
                                            $dataDescuento = $producto->descuentos->firstWhere(
                                                'lista_precio_id',
                                                $listaPrecio->id,
                                            );

                                            $fechaFinVencida =
                                                $dataDescuento &&
                                                \Carbon\Carbon::parse($dataDescuento->fecha_fin)->isPast();
                                        @endphp
                                        <td class="g_resaltar">
                                            <div>
                                                <strong>Descuento:</strong>
                                                {{ $dataDescuento ? $dataDescuento->porcentaje_descuento : '-' }}%
                                            </div>
                                            <div
                                                style="color: {{ $fechaFinVencida && $dataDescuento->porcentaje_descuento ? 'red' : 'black' }}">
                                                <strong>Fin:</strong>
                                                {{ $dataDescuento ? $dataDescuento->fecha_fin : '-' }}
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($productos->hasPages())
                <div>
                    {{ $productos->onEachSide(1)->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay elementos.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
