@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Marcas')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Crear marca</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.marca.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.marca.vista.todas') }}" class="g_boton g_boton_primary">
                    Regresar <i class="fa-solid fa-rotate-left"></i></a>
            </div>
        </div>

        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">General</h4>
                    <form action="{{ route('erp.marca.crear') }}" method="POST">
                        @csrf
                        <p>Nombre:</p>
                        <input type="text" name="nombre">
                        <br>

                        <p>Descripción:</p>
                        <textarea name="descripcion"></textarea>
                        <br>

                        <button type="submit">Enviar</button>
                    </form>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <p>2</p>
                </div>
            </div>
        </div>


    </div>
@endsection
