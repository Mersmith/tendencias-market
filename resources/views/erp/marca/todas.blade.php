@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Marcas')

@section('content')
    <div>

        <!--CONTENEDOR CABECERA-->
        <div class="card cabecera_titulo_pagina">
            <!--CONTENEDOR TITULO-->
            <h2>Marcas <span>Cantidad: 100</span></h2>

            <!--CONTENEDOR BOTONES-->
            <div class="contenedor_botones_erp">
                <a href="{{ route('erp.marca.vista.todas') }}" class="">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.marca.vista.crear') }}" class="btn-primary">
                    Crear <i class="fa-solid fa-square-plus"></i></a>
            </div>
        </div>

        <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
        <div class="card">
            <!--TABLA-->
            @if ($marcas->count())
                <div class="tabla_cabecera">
                    <!--CONTENEDOR BOTONES-->
                    <div class="contenedor_botones_erp_control">
                        <button>
                            PDF <i class="fa-solid fa-file-pdf"></i>
                        </button>
                        <button>
                            EXCEL <i class="fa-regular fa-file-excel"></i>
                        </button>
                    </div>

                    <!--CONTENEDOR SUBTITULO-->
                    <div class="contenedor_subtitulo_erp">
                        <form action="">
                            <input type="text" class="form-control" id="text-srh"
                                placeholder="Search Product">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </form>
                    </div>
                </div>

                <!--TABLA-->
                <div class="tabla_administrador">
                    <div class="contenedor_tabla">
                        <table class="tabla">
                            <thead>
                                <tr>
                                    <th>
                                        Nº</th>
                                    <th>
                                        Nombre</th>
                                    <th>
                                        Descripción</th>
                                    <th>
                                        Activo</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marcas as $item)
                                    <tr>
                                        <td class="resaltar">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="resaltar">
                                            {{ $item->nombre }}
                                        </td>
                                        <td class="inferior resumir">
                                            {{ $item->descripcion }}
                                        </td>
                                        <td class="inferior">
                                            <span class="estado {{ $item->activo == 1 ? 'activo' : 'desactivado' }}"><i
                                                    class="fa-solid fa-circle"></i></span>
                                            @if ($item->activo == 1)
                                                Activo
                                            @else
                                                Desactivo
                                            @endif
                                        </td>
                                        <td class="centrar_iconos">
                                            <a href="{{ route('erp.marca.vista.ver', $item->id) }}" class="accion_ver">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a href="{{ route('erp.marca.vista.editar', $item->id) }}"
                                                class="accion_editar">
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
                <div class="contenedor_no_existe_elementos">
                    <p>No hay elementos.</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>
    </div>
@endsection
