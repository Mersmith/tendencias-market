@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Categorias')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Editar categoria</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.categoria.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.categoria.vista.crear') }}" class="g_boton g_boton_primary">
                    Crear <i class="fa-solid fa-square-plus"></i></a>

                <button class="g_boton g_boton_danger" id="eliminarCategoria">
                    Eliminar <i class="fa-solid fa-trash-can"></i>
                </button>
                <form action="{{ route('erp.categoria.eliminar', $categoria->id) }}" method="POST"
                    id="formEliminarCategoria" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                <a href="{{ route('erp.categoria.vista.todas') }}" class="g_boton g_boton_darkt">
                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>

        <form action="{{ route('erp.categoria.editar', $categoria->id) }}" method="POST" class="formulario">
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
                            <input type="text" id="nombre" name="nombre"
                                value="{{ old('nombre', $categoria->nombre) }}">
                            <p class="leyenda">La categoria debe tener un nombre único.</p>
                            @error('nombre')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="g_margin_bottom_20">
                            <label for="slug">Slug <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $categoria->slug) }}">
                            <p class="leyenda">La categoria debe tener un slug único.</p>
                            @error('slug')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                            <p class="leyenda">Se mostrará en el SEO.</p>
                            @error('descripcion')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="icono">Icono</label>
                            <input type="text" id="icono" name="icono"
                                value="{{ old('icono', $categoria->icono) }}">
                            @error('icono')
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
                            <option value="2" {{ old('activo', $categoria->activo) == '2' ? 'selected' : '' }}>
                                DESACTIVADO
                            </option>
                            <option value="1" {{ old('activo', $categoria->activo) == '1' ? 'selected' : '' }}>ACTIVO
                            </option>
                        </select>
                        @error('activo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="formulario_botones">
                    <button type="submit" class="guardar">Guardar</button>

                    <a href="{{ route('erp.categoria.vista.todas') }}" class="cancelar">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <!--ALERTA-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('eliminarCategoria').addEventListener('click', function(e) {
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
                        document.getElementById('formEliminarCategoria').submit();
                    }
                });
            });
        });
    </script>
@endsection
