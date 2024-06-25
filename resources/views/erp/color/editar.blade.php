@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Colores')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Editar color</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.color.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.color.vista.crear') }}" class="g_boton g_boton_primary">
                    Crear <i class="fa-solid fa-square-plus"></i></a>

                <button class="g_boton g_boton_danger" id="eliminarColor">
                    Eliminar <i class="fa-solid fa-trash-can"></i>
                </button>
                <form action="{{ route('erp.color.eliminar', $color->id) }}" method="POST" id="formEliminarColor"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                <a href="{{ route('erp.color.vista.todas') }}" class="g_boton g_boton_darkt">
                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>

        <form action="{{ route('erp.color.editar', $color->id) }}" method="POST" class="formulario">
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
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $color->nombre) }}">
                            <p class="leyenda">La color debe ser único.</p>
                            @error('nombre')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="g_margin_bottom_20">
                            <label for="nombre">Código color <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="color" id="codigo_color" name="codigo_color"
                                value="{{ old('codigo_color', $color->codigo_color) }}">
                            <p class="leyenda">La código de color debe ser único.</p>
                            @error('codigo_color')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="g_columna_4">
                    <div class="g_panel">
                        <h4 class="g_panel_titulo">Activo</h4>
                        <select id="activo" name="activo">
                            <option value="" disabled>Seleccione</option>
                            <option value="2" {{ old('activo', $color->activo) == '2' ? 'selected' : '' }}>DESACTIVADO
                            </option>
                            <option value="1" {{ old('activo', $color->activo) == '1' ? 'selected' : '' }}>ACTIVO
                            </option>
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

    <!--ALERTA-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('eliminarColor').addEventListener('click', function(e) {
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
                        document.getElementById('formEliminarColor').submit();
                    }
                });
            });
        });
    </script>
@endsection
