@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Crear categoria')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Crear categoria</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.categoria.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.categoria.vista.todas') }}" class="g_boton g_boton_darkt">
                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>

        <!--FORMULARIO-->
        <form action="{{ route('erp.categoria.crear') }}" method="POST" class="formulario">
            @csrf
            <div class="g_fila">
                <div class="g_columna_8">
                    <div class="g_panel">
                        <!--TITULO-->
                        <h4 class="g_panel_titulo">General</h4>

                        <!-- CÓDIGO -->
                        <div class="g_margin_bottom_20">
                            <label for="codigo">Código <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}">
                            <p class="leyenda">El código debe ser único.</p>
                            @error('codigo')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--NOMBRE-->
                        <div class="g_margin_bottom_20">
                            <label for="nombre">Nombre <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
                            <p class="leyenda">La categoria debe tener un nombre único.</p>
                            @error('nombre')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--SLUG-->
                        <div class="g_margin_bottom_20">
                            <label for="slug">Slug <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug') }}">
                            <p class="leyenda">La categoria debe tener un slug único.</p>
                            @error('slug')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--DESCRIPCION-->
                        <div class="g_margin_bottom_20">
                            <label for="descripcion">Descripción <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <textarea id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                            <p class="leyenda">Se mostrará en el SEO.</p>
                            @error('descripcion')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--ICONO-->
                        <div>
                            <label for="icono">Icono</label>
                            <input type="text" id="icono" name="icono" value="{{ old('icono') }}">
                            @error('icono')
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

                        <!--CATEGORIA PADRE-->
                        {{--<div class="g_margin_bottom_20">
                            <label for="categoria_padre_id">Categoria padre</label>
                            <select id="categoria_padre_id" name="categoria_padre_id">
                                <option value="" selected>Ninguna</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @if (old('categoria_padre_id') == $categoria->id) selected @endif>
                                        {{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                            <p class="leyenda">Solo se acepta 3 niveles.</p>
                            @error('categoria_padre_id')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>--}}

                        <!-- ORDEN -->
                        <div class="g_margin_bottom_20">
                            <label for="orden">orden</label>
                            <input type="number" id="orden" name="orden" value="{{ old('orden', 0) }}">
                            @error('orden')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="formulario_botones">
                    <button type="submit" class="guardar">Guardar</button>

                    <a href="{{ route('erp.categoria.vista.todas') }}" class="cancelar">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
