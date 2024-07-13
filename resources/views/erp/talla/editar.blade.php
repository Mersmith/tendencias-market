@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Editar talla')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Editar talla</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.talla.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.talla.vista.crear') }}" class="g_boton g_boton_primary">
                    Crear <i class="fa-solid fa-square-plus"></i></a>

                <button class="g_boton g_boton_danger" id="eliminarTalla">
                    Eliminar <i class="fa-solid fa-trash-can"></i>
                </button>
                <form action="{{ route('erp.talla.eliminar', $talla->id) }}" method="POST" id="formEliminarTalla"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                <a href="{{ route('erp.talla.vista.todas') }}" class="g_boton g_boton_darkt">
                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>

        <!--FORMULARIO-->
        <form action="{{ route('erp.talla.editar', $talla->id) }}" method="POST" class="formulario">
            @csrf
            @method('PUT')
            <div class="g_fila">
                <div class="g_columna_8">
                    <div class="g_panel">
                        <!--TITULO-->
                        <h4 class="g_panel_titulo">General</h4>

                        <!--NOMBRE-->
                        <div class="g_margin_bottom_20">
                            <label for="nombre">Talla <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $talla->nombre) }}">
                            <p class="leyenda">La talla debe ser único.</p>
                            @error('nombre')
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
                            <option value="0" {{ old('activo', $talla->activo) == '0' ? 'selected' : '' }}>DESACTIVADO
                            </option>
                            <option value="1" {{ old('activo', $talla->activo) == '1' ? 'selected' : '' }}>ACTIVO
                            </option>
                        </select>
                        @error('activo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="formulario_botones">
                    <button type="submit" class="guardar">Actualizar</button>

                    <a href="{{ route('erp.talla.vista.todas') }}" class="cancelar">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <!--ALERTA-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('eliminarTalla').addEventListener('click', function(e) {
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
                        document.getElementById('formEliminarTalla').submit();
                    }
                });
            });
        });
    </script>
@endsection
