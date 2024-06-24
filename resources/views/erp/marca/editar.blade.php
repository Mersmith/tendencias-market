@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Marcas')

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

                <button class="g_boton g_boton_danger" id="eliminarMarca">
                    Eliminar <i class="fa-solid fa-trash-can"></i>
                </button>
                <form action="{{ route('erp.marca.eliminar', $marca->id) }}" method="POST" id="formEliminarMarca"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                <a href="{{ route('erp.marca.vista.todas') }}" class="g_boton g_boton_darkt">
                    Regresar <i class="fa-solid fa-rotate-left"></i></a>
            </div>
        </div>

        <form action="{{ route('erp.marca.editar', $marca->id) }}" method="POST" class="formulario">
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
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $marca->nombre) }}">
                            <p class="leyenda">La marca debe tener un nombre único.</p>
                            @error('nombre')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>
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
                        <h4 class="g_panel_titulo">Activo</h4>
                        <select id="activo" name="activo">
                            <option value="" disabled>Seleccione</option>
                            <option value="2" {{ old('activo', $marca->activo) == '2' ? 'selected' : '' }}>DESACTIVADO
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
                    <button type="submit" class="guardar">Guardar</button>

                    <a href="{{ route('erp.marca.vista.todas') }}" class="cancelar">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('eliminarMarca').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recuparlo.",
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
</script>
