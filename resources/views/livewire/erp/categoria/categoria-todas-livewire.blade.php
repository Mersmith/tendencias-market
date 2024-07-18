@section('tituloPagina', 'Categorias')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Categorias</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.categoria.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('erp.categoria.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        @if ($categoriasAgrupadas->count())
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
                        <input type="text" wire:model.live.debounce.1300ms="buscarCategoria" id="buscarCategoria"
                            name="buscarCategoria" placeholder="Buscar...">
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
                                <th>Nº</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Descripción</th>
                                <th>Orden</th>
                                <th>Icono</th>
                                <th>Activo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoriasAgrupadas[null] ?? [] as $item)
                                <tr>
                                    <td class="g_resaltar" style="padding-left: 5px;">Categoria {{ $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $item->codigo }}</td>
                                    <td class="g_resaltar">ID: {{ $item->id }} - {{ $item->nombre }}</td>
                                    <td class="g_resaltar">{{ $item->slug }}</td>
                                    <td class="g_inferior g_resumir">{{ $item->descripcion }}</td>
                                    <td class="g_inferior">{{ $item->orden }}</td>
                                    <td>{!! $item->icono !!}</td>
                                    <td class="g_inferior">
                                        <span class="estado {{ $item->activo == 1 ? 'g_activo' : 'g_desactivado' }}">
                                            <i class="fa-solid fa-circle"></i>
                                        </span>
                                        {{ $item->activo == 1 ? 'Activo' : 'Desactivado' }}
                                    </td>
                                    <td class="centrar_iconos">
                                        <a href="{{ route('erp.categoria.vista.editar', $item->id) }}" class="g_accion_editar">
                                            <span><i class="fa-solid fa-pencil"></i></span>
                                        </a>
                                    </td>
                                </tr>
                    
                                @foreach ($categoriasAgrupadas[$item->id] ?? [] as $hijo)
                                    <tr>
                                        <td class="g_inferior" style="padding-left: 20px;">Subcategoria {{ $loop->iteration }}</td>
                                        <td class="g_resaltar">{{ $hijo->codigo }}</td>
                                        <td class="g_resaltar">ID: {{ $hijo->id }} - {{ $hijo->nombre }}</td>
                                        <td class="g_resaltar">{{ $hijo->slug }}</td>
                                        <td class="g_inferior g_resumir">{{ $hijo->descripcion }}</td>
                                        <td class="g_inferior">{{ $hijo->orden }}</td>
                                        <td>{!! $hijo->icono !!}</td>
                                        <td class="g_inferior">
                                            <span class="estado {{ $hijo->activo == 1 ? 'g_activo' : 'g_desactivado' }}">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            {{ $hijo->activo == 1 ? 'Activo' : 'Desactivado' }}
                                        </td>
                                        <td class="centrar_iconos">
                                            <a href="{{ route('erp.categoria.vista.editar', $hijo->id) }}" class="g_accion_editar">
                                                <span><i class="fa-solid fa-pencil"></i></span>
                                            </a>
                                        </td>
                                    </tr>
                    
                                    @foreach ($categoriasAgrupadas[$hijo->id] ?? [] as $subhijo)
                                        <tr>
                                            <td class="g_resaltar" style="padding-left: 35px;">Sub Item {{ $loop->iteration }}</td>
                                            <td class="g_resaltar">{{ $subhijo->codigo }}</td>
                                            <td class="g_resaltar">ID: {{ $subhijo->id }} - {{ $subhijo->nombre }}</td>
                                            <td class="g_resaltar">{{ $subhijo->slug }}</td>
                                            <td class="g_inferior g_resumir">{{ $subhijo->descripcion }}</td>
                                            <td class="g_inferior">{{ $subhijo->orden }}</td>
                                            <td>{!! $subhijo->icono !!}</td>
                                            <td class="g_inferior">
                                                <span class="estado {{ $subhijo->activo == 1 ? 'g_activo' : 'g_desactivado' }}">
                                                    <i class="fa-solid fa-circle"></i>
                                                </span>
                                                {{ $subhijo->activo == 1 ? 'Activo' : 'Desactivado' }}
                                            </td>
                                            <td class="centrar_iconos">
                                                <a href="{{ route('erp.categoria.vista.editar', $subhijo->id) }}" class="g_accion_editar">
                                                    <span><i class="fa-solid fa-pencil"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    
                    
                </div>
            </div>
        @else
            <div class="g_vacio">
                <p>No hay elementos.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
