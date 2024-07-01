@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Series')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Editar serie</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.serie.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.serie.vista.crear') }}" class="g_boton g_boton_primary">
                    Crear <i class="fa-solid fa-square-plus"></i></a>

                <button class="g_boton g_boton_danger" id="eliminarSerie">
                    Eliminar <i class="fa-solid fa-trash-can"></i>
                </button>
                <form action="{{ route('erp.serie.eliminar', $serie->id) }}" method="POST" id="formEliminarSerie"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                <a href="{{ route('erp.serie.vista.todas') }}" class="g_boton g_boton_darkt">
                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>

        <form action="{{ route('erp.serie.editar', $serie->id) }}" method="POST" class="formulario">
            @csrf
            @method('PUT')
            <div class="g_fila">
                <div class="g_columna_8">
                    <div class="g_panel">
                        <h4 class="g_panel_titulo">General</h4>
                        @csrf
                        <div class="g_margin_bottom_20">
                            <label for="nombre">Nombre <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $serie->nombre) }}">
                            <p class="leyenda">La serie debe tener un nombre único.</p>
                            @error('nombre')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="g_margin_bottom_20">
                            <label for="correlativo">Correlativo <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="number" id="correlativo" name="correlativo"
                                value="{{ old('correlativo', $serie->correlativo) }}">
                            <p class="leyenda">Solo debe ser número entero.</p>
                            @error('correlativo')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="descripcion">Descripción <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <textarea id="descripcion" name="descripcion">{{ old('descripcion', $serie->descripcion) }}</textarea>
                            <p class="leyenda">Se mostrará en el SEO.</p>
                            @error('descripcion')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="g_columna_4">
                    <div class="g_panel">
                        <h4 class="g_panel_titulo">Activo</h4>
                        <select id="activo" name="activo">
                            <option value="0" {{ old('activo', $serie->activo) == '0' ? 'selected' : '' }}>
                                DESACTIVADO
                            </option>
                            <option value="1" {{ old('activo', $serie->activo) == '1' ? 'selected' : '' }}>
                                ACTIVO
                            </option>
                        </select>
                        @error('activo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_panel">
                        <h4 class="g_panel_titulo">Detalle</h4>

                        <div class="g_margin_bottom_20">
                            <label for="slug">Sede <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <select id="sede_id" name="sede_id">
                                <option value="" @if (old('sede_id', $serie->sede_id) == '') selected @endif disabled>Seleccione
                                </option>
                                @foreach ($sedes as $sede)
                                    <option value="{{ $sede->id }}" @if (old('sede_id', $serie->sede_id) == $sede->id) selected @endif>
                                        {{ $sede->nombre }}</option>
                                @endforeach
                            </select>
                            @error('sede_id')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="slug">Tipo documento <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <select id="tipo_documento_id" name="tipo_documento_id">
                                <option value="" @if (old('tipo_documento_id', $serie->tipo_documento_id) == '') selected @endif disabled>Seleccione
                                </option>
                                @foreach ($tipo_documentos as $tipo_documento)
                                    <option value="{{ $tipo_documento->id }}"
                                        @if (old('tipo_documento_id', $serie->tipo_documento_id) == $tipo_documento->id) selected @endif>
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

    <!--ALERTA-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('eliminarSerie').addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Quieres eliminar?',
                    text: "No podrás recuperarlo.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('formEliminarSerie').submit();
                    }
                });
            });
        });
    </script>
@endsection
