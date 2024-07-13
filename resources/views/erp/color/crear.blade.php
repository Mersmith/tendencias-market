@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Crear color')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Crear color</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.color.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.color.vista.todas') }}" class="g_boton g_boton_darkt">
                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>

        <!--FORMULARIO-->
        <form action="{{ route('erp.color.crear') }}" method="POST" class="formulario">
            @csrf
            <div class="g_fila">
                <div class="g_columna_8">
                    <div class="g_panel">
                        <!--TITULO-->
                        <h4 class="g_panel_titulo">General</h4>

                        <!--COLOR-->
                        <div class="g_margin_bottom_20">
                            <label for="nombre">Color <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
                            <p class="leyenda">La color debe ser único.</p>
                            @error('nombre')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--CODIGO-->
                        <div class="g_margin_bottom_20">
                            <label for="codigo_color">Código color <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="color" id="codigo_color" name="codigo_color" value="{{ old('codigo_color') }}">
                            <p class="leyenda">La código de color debe ser único.</p>
                            @error('codigo_color')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="g_columna_4">
                    <div class="g_panel">
                        <!--TITULO-->
                        <h4 class="g_panel_titulo">Activo</h4>

                        <!--ACTIVO-->
                        <select id="activo" name="activo">
                            <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>DESACTIVADO</option>
                            <option value="1" {{ old('activo') == '1' ? 'selected' : '' }}>ACTIVO</option>
                        </select>
                        @error('activo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="formulario_botones">
                    <button type="submit" class="guardar">Guardar</button>

                    <a href="{{ route('erp.color.vista.todas') }}" class="cancelar">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
