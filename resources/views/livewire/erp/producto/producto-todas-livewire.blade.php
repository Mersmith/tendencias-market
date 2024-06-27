@section('tituloPagina', 'Productos')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Productos <span>Total: {{ $productos->count() }}</span></h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('erp.producto.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="g_panel">
        <!--TABLA-->
        @if ($productos->count())
            <!--TABLA CABECERA-->
            <div class="tabla_cabecera">
                <!--TABLA CABECERA BOTONES-->
                <div class="tabla_cabecera_botones">
                    <button>
                        PDF <i class="fa-solid fa-file-pdf"></i>
                    </button>

                    <button>
                        EXCEL <i class="fa-regular fa-file-excel"></i>
                    </button>
                </div>

                <!--TABLA CABECERA BUSCAR-->
                <div class="tabla_cabecera_buscar">
                    <form action="">
                        <input type="text" wire:model.live.debounce.1300ms="buscarProducto" id="buscarProducto"
                            name="buscarProducto" placeholder="Buscar...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                </div>
            </div>

            <!--TABLA CONTENIDO-->
            <div class="tabla_contenido">
                <div class="contenedor_tabla">
                    <!--TABLA-->
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>
                                    Nº</th>
                                <th>
                                    Nombre</th>
                                <th>
                                    Slug</th>
                                <th>
                                    Descripción</th>
                                <th>
                                    Activo</th>
                                <th>
                                    Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $item)
                                <tr>
                                    <td class="g_resaltar">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="g_resaltar">
                                        {{ $item->nombre }}
                                    </td>
                                    <td class="g_resaltar">
                                        {{ $item->slug }}
                                    </td>
                                    <td class="g_inferior g_resumir">
                                        {{ $item->descripcion }}
                                    </td>
                                    <td class="g_inferior">
                                        <span class="estado {{ $item->activo == 1 ? 'g_activo' : 'g_desactivado' }}"><i
                                                class="fa-solid fa-circle"></i></span>
                                        @if ($item->activo == 1)
                                            Activo
                                        @else
                                            Desactivo
                                        @endif
                                    </td>
                                    <td class="centrar_iconos">
                                        {{-- <a href="{{ route('erp.categoria.vista.editar', $item->id) }}"
                                            class="g_accion_editar">
                                            <span><i class="fa-solid fa-pencil"></i></span>
                                        </a> --}}

                                        <a href="{{ route('erp.producto.variacion.vista.editar', $item) }}"
                                            class="g_accion_ver">
                                            <span><i class="fa-solid fa-align-center"></i></span>
                                        </a>

                                        <a href="{{ route('erp.producto.inventario.vista.ver', ['id' => $item->id]) }}"
                                            class="g_inventario">
                                            <span><i class="fa-solid fa-list-ol"></i></span>
                                        </a>

                                        <a href="{{ route('erp.producto.lista.precio.vista.editar', ['id' => $item->id]) }}"
                                            class="g_activo">
                                            <span><i class="fa-solid fa-dollar-sign"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($productos->hasPages())
                <div>
                    {{ $productos->links('pagination::tailwind') }}
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
