@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Editar marca')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Editar marca</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.marca.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.marca.vista.crear') }}" class="g_boton g_boton_primary">
                    Crear <i class="fa-solid fa-square-plus"></i></a>



                @if ($marca->deleted_at)
                    <form action="{{ route('erp.marca.restaurar', $marca->id) }}" method="POST" id="formRestaurarMarca"
                        style="display: inline;">
                        @csrf
                        <button type="submit" class="g_boton g_boton_success" id="restaurarMarca">
                            Restaurar <i class="fa-solid fa-undo"></i>
                        </button>
                    </form>
                @else
                    <form action="{{ route('erp.marca.eliminar', $marca->id) }}" method="POST" id="formEliminarMarca"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button class="g_boton g_boton_danger" id="eliminarMarca">
                            Eliminar <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                @endif

                <a href="{{ route('erp.marca.vista.todas') }}" class="g_boton g_boton_darkt">
                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>

        <!--FORMULARIO-->
        <form action="{{ route('erp.marca.editar', $marca->id) }}" method="POST" class="formulario">
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
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $marca->nombre) }}">
                            <p class="leyenda">La marca debe tener un nombre único.</p>
                            @error('nombre')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--DESCRIPCION-->
                        <div>
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion">{{ old('descripcion', $marca->descripcion) }}</textarea>
                            <p class="leyenda">Se mostrará en el SEO.</p>
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
                            <option value="0" {{ old('activo', $marca->activo) == '0' ? 'selected' : '' }}>DESACTIVADO
                            </option>
                            <option value="1" {{ old('activo', $marca->activo) == '1' ? 'selected' : '' }}>ACTIVO
                            </option>
                        </select>
                        @error('activo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="formulario_botones">
                    <button type="submit" class="guardar">Actualizar</button>

                    <a href="{{ route('erp.marca.vista.todas') }}" class="cancelar">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <!--ALERTA-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('eliminarMarca').addEventListener('click', function(e) {
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
                        document.getElementById('formEliminarMarca').submit();
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('restaurarMarca').addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Quieres restaurar?',
                    text: "Este registro será restaurado.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, restaurar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('formRestaurarMarca').submit();
                    }
                });
            });
        });
    </script>
@endsection
