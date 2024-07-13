@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Editar almacén')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Editar almacén</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.almacen.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.almacen.vista.crear') }}" class="g_boton g_boton_primary">
                    Crear <i class="fa-solid fa-square-plus"></i></a>

                <button class="g_boton g_boton_danger" id="eliminarAlmacen">
                    Eliminar <i class="fa-solid fa-trash-can"></i>
                </button>
                <form action="{{ route('erp.almacen.eliminar', $almacen->id) }}" method="POST" id="formEliminarAlmacen"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                <a href="{{ route('erp.almacen.vista.todas') }}" class="g_boton g_boton_darkt">
                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>

        <!--FORMULARIO-->
        <form action="{{ route('erp.almacen.editar', $almacen->id) }}" method="POST" class="formulario">
            @csrf
            @method('PUT')
            <div class="g_fila">
                <div class="g_columna_8">
                    <div class="g_panel">
                        <!--TITULO-->
                        <h4 class="g_panel_titulo">General</h4>

                        <!--NOMBRE-->
                        <div class="g_margin_bottom_20">
                            <label for="nombre">Nombre <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="nombre" name="nombre"
                                value="{{ old('nombre', $almacen->nombre) }}">
                            <p class="leyenda">La almacen debe tener un nombre único.</p>
                            @error('nombre')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--UBICACION-->
                        <div>
                            <label for="ubicacion">Ubicación <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <textarea id="ubicacion" name="ubicacion">{{ old('ubicacion', $almacen->ubicacion) }}</textarea>
                            @error('ubicacion')
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
                            <option value="0" {{ old('activo', $almacen->activo) == '0' ? 'selected' : '' }}>
                                DESACTIVADO
                            </option>
                            <option value="1" {{ old('activo', $almacen->activo) == '1' ? 'selected' : '' }}>
                                ACTIVO
                            </option>
                        </select>
                        @error('activo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_panel">
                        <!--DETALLE-->
                        <h4 class="g_panel_titulo">Detalle</h4>

                        <!--SEDE-->
                        <label for="sede_id">Sede <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="sede_id" name="sede_id">
                            <option value="" @if (old('sede_id', $almacen->sede_id) == '') selected @endif disabled>Seleccione
                            </option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}" @if (old('sede_id', $almacen->sede_id) == $sede->id) selected @endif>
                                    {{ $sede->nombre }}</option>
                            @endforeach
                        </select>
                        @error('sede_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="formulario_botones">
                    <button type="submit" class="guardar">Actualizar</button>

                    <a href="{{ route('erp.almacen.vista.todas') }}" class="cancelar">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <!--ALERTA-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('eliminarAlmacen').addEventListener('click', function(e) {
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
                        document.getElementById('formEliminarAlmacen').submit();
                    }
                });
            });
        });
    </script>
@endsection
