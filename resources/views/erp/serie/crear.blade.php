@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Crear serie')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Crear serie</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.serie.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.serie.vista.todas') }}" class="g_boton g_boton_darkt">
                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>

        <!--FORMULARIO-->
        <form action="{{ route('erp.serie.crear') }}" method="POST" class="formulario">
            @csrf
            <div class="g_fila">
                <div class="g_columna_8">
                    <div class="g_panel">
                        <!--TITULO-->
                        <h4 class="g_panel_titulo">General</h4>

                        <!--NOMBRE-->
                        <div class="g_margin_bottom_20">
                            <label for="nombre">Serie <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
                            <p class="leyenda">La serie debe tener un nombre único.</p>
                            @error('nombre')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--CORRELATIVO-->
                        <div class="g_margin_bottom_20">
                            <label for="correlativo">Correlativo <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="number" id="correlativo" name="correlativo" value="{{ old('correlativo') }}">
                            <p class="leyenda">Solo debe ser número entero.</p>
                            @error('correlativo')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--DESCRIPCION-->
                        <div>
                            <label for="descripcion">Descripción <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <textarea id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
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

                    <div class="g_panel">
                        <!--TITULO-->
                        <h4 class="g_panel_titulo">Detalle</h4>

                        <!--SEDE-->
                        <div class="g_margin_bottom_20">
                            <label for="sede_id">Sede <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <select id="sede_id" name="sede_id">
                                <option value="" @if (old('sede_id') == '') selected @endif disabled>Seleccione
                                </option>
                                @foreach ($sedes as $sede)
                                    <option value="{{ $sede->id }}" @if (old('sede_id') == $sede->id) selected @endif>
                                        {{ $sede->nombre }}</option>
                                @endforeach
                            </select>
                            @error('sede_id')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--TIPO DOCUMENTO-->
                        <div>
                            <label for="tipo_documento_id">Tipo documento <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <select id="tipo_documento_id" name="tipo_documento_id">
                                <option value="" @if (old('tipo_documento_id') == '') selected @endif disabled>Seleccione
                                </option>
                                @foreach ($tipo_documentos as $tipo_documento)
                                    <option value="{{ $tipo_documento->id }}"
                                        @if (old('tipo_documento_id') == $tipo_documento->id) selected @endif>
                                        {{ $tipo_documento->nombre }}</option>
                                @endforeach
                            </select>
                            @error('tipo_documento_id')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="formulario_botones">
                    <button type="submit" class="guardar">Guardar</button>

                    <a href="{{ route('erp.serie.vista.todas') }}" class="cancelar">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
