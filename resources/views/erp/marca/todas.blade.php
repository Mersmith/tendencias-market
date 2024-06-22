@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Marcas')

@section('content')
    <div>

        <!--CONTENEDOR CABECERA-->
        <div class="cabecera_titulo_pagina">
            <!--CONTENEDOR TITULO-->
            <h2>Marcas</h2>

            <!--CONTENEDOR BOTONES-->
            <div class="contenedor_botones_erp">
                <a href="{{ route('erp.marca.vista.todas') }}" class="">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.marca.vista.crear') }}" class="btn-primary">
                    Crear <i class="fa-solid fa-square-plus"></i></a>
            </div>
        </div>

        <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
        <div class="contenedor_erp_panel">
            <!--TABLA-->
            <div class="contenedor_panel_cuerpo">
                @if ($marcas->count())
                    <!--CONTENEDOR SUBTITULO-->
                    <div class="contenedor_subtitulo_erp">
                        <h3>Lista<span> Cantidad: {{ $marcas->count() }}</span></h3>
                    </div>

                    <!--CONTENEDOR BOTONES-->
                    <div class="contenedor_botones_erp">
                        <button>
                            PDF <i class="fa-solid fa-file-pdf"></i>
                        </button>
                        <button>
                            EXCEL <i class="fa-regular fa-file-excel"></i>
                        </button>
                    </div>

                    <!--TABLA-->
                    <div class="tabla_administrador py-4 overflow-x-auto">
                        <div class="inline-block min-w-full overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th>
                                            Nº</th>
                                        <th>
                                            nombre</th>
                                        <th>
                                            Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($marcas as $item)
                                        <tr style="text-align: center;">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->nombre }}
                                            </td>
                                            <td>
                                                <a style="color: #009eff;"
                                                    href="{{ route('erp.marca.vista.ver', $item->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>

                                                <a style="color: teal;"
                                                    href="{{ route('erp.marca.vista.editar', $item->id) }}">
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
    </div>
@endsection
