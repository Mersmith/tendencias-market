@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Almacenes')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Crear almacen</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.almacen.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.almacen.vista.todas') }}" class="g_boton g_boton_darkt">
                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>

        <form action="{{ route('erp.almacen.crear') }}" method="POST" class="formulario">
            @csrf
            <div class="g_fila">
                <div class="g_columna_8">
                    <div class="g_panel">
                        <h4 class="g_panel_titulo">General</h4>
                        @csrf
                        <div class="g_margin_bottom_20">
                            <label for="nombre">Nombre <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
                            <p class="leyenda">La almacen debe tener un nombre único.</p>
                            @error('nombre')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="ubicacion">Ubicación <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <textarea id="ubicacion" name="ubicacion">{{ old('ubicacion') }}</textarea>
                            <p class="leyenda">Se mostrará en el SEO.</p>
                            @error('ubicacion')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="g_columna_4">
                    <div class="g_panel">
                        <h4 class="g_panel_titulo">Activo</h4>
                        <select id="activo" name="activo">
                            <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>DESACTIVADO</option>
                            <option value="1" {{ old('activo') == '1' ? 'selected' : '' }}>ACTIVO</option>
                        </select>
                        @error('activo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_panel">
                        <h4 class="g_panel_titulo">Detalle</h4>

                        <label for="slug">Sede <span class="obligatorio"><i
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
                </div>

                <div class="formulario_botones">
                    <button type="submit" class="guardar">Guardar</button>

                    <a href="{{ route('erp.almacen.vista.todas') }}" class="cancelar">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
