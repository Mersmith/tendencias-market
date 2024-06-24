@extends('layouts.erp.layout-erp')

@section('tituloPagina', 'Marcas')

@section('content')
    <div>
        <!--CABECERA TITULO PAGINA-->
        <div class="g_panel cabecera_titulo_pagina">
            <!--TITULO-->
            <h2>Crear marca</h2>

            <!--BOTONES-->
            <div class="cabecera_titulo_botones">
                <a href="{{ route('erp.marca.vista.todas') }}" class="g_boton g_boton_light">
                    Inicio <i class="fa-solid fa-house"></i></a>

                <a href="{{ route('erp.marca.vista.todas') }}" class="g_boton g_boton_primary">
                    Regresar <i class="fa-solid fa-rotate-left"></i></a>
            </div>
        </div>

        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">General</h4>
                    <form action="{{ route('erp.marca.crear') }}" method="POST" class="formulario">
                        @csrf
                        <div class="g_margin_bottom_20">
                            <label for="nombre">Nombre <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="nombre" name="nombre">
                            <p class="leyenda">La marca debe tener un nombre único.</p>
                        </div>
                        <div>
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion"></textarea>
                            <p class="leyenda">Se mostrará en el SEO.</p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">Estado</h4>
                    <form action="{{ route('erp.marca.crear') }}" method="POST" class="formulario">
                        @csrf
                        <select id="estado" name="estado">
                            <option value="" disabled>Seleccione</option>
                            <option value="INHABILITADO">INHABILITADO</option>
                            <option value="HABILITADO">HABILITADO</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="formulario_botones">
                <button class="guardar">Guardar</button>
                <button class="cancelar">Cancelar</button>
            </div>
        </div>


    </div>
@endsection
