@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Almacenes')

@section('anchoPantalla', '100%')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Almacenes</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.almacen.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.almacen.vista.crear') }}" class="g_boton g_boton_primary">
                    Crear <i class="fa-solid fa-square-plus"></i></a>
            </div>
        </div>

        <!--TABLA-->
        <div class="g_panel">
            @if ($almacenes->count())
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
                            <input type="text" id="buscar" name="buscar" placeholder="Buscar...">
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
                                    <th>Almacén</th>
                                    <th>Sede</th>
                                    <th>Ubicación</th>
                                    <th>Activo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($almacenes as $item)
                                    <tr>
                                        <td class="g_resaltar"> {{ $loop->iteration }}</td>
                                        <td class="g_resaltar">ID: {{ $item->id }} - {{ $item->nombre }}</td>
                                        <td>ID:{{ $item->sede->id }} - {{ $item->sede->nombre }}</td>
                                        <td class="g_inferior g_resumir"> {{ $item->ubicacion }}</td>
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
                                            <a href="{{ route('erp.almacen.vista.editar', $item->id) }}"
                                                class="g_accion_editar">
                                                <span><i class="fa-solid fa-pencil"></i></span>
                                            </a>
                                        </td>
                                    </tr>
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
@endsection
