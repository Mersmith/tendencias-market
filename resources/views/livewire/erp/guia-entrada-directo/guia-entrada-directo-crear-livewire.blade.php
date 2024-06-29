@section('tituloPagina', 'Guia de Entrada Directo')

<div>

    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Crear guia de entrada directo</h2>
    </div>

    <!-- CONTENEDOR PÁGINA ADMINISTRADOR -->
    <div class="g_panel">
        <!-- TABLA -->
        @if ($variaciones->count())
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
                    <!-- TABLA -->
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nombre Producto</th>
                                <th>Nombre Color</th>
                                <th>Nombre Talla</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variaciones as $variacion)
                                <tr wire:click="seleccionarIdVariacion({{ $variacion->id }})" style="cursor: pointer;">
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $variacion->producto->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $variacion->color->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $variacion->talla->nombre ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($variaciones->hasPages())
                <div>
                    {{ $variaciones->links('pagination::tailwind') }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay elementos.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>

    <!-- MOSTRAR INVENTARIOS -->
    @if ($inventarios)
        <div class="g_panel">
            <div class="tabla_contenido">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Sede</th>
                                <th>Almacén</th>
                                <th>Stock</th>
                                <th>Stock Mínimo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventarios as $inventario)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $inventario->almacen->sede->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $inventario->almacen->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $inventario->stock }}</td>
                                    <td class="g_resaltar">{{ $inventario->stock_minimo }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
