@section('tituloPagina', 'Editar')

<div>
    <!-- CABECERA TITULO PAGINA -->
    <div class="g_panel cabecera_titulo_pagina">
        <h2>Editar producto</h2>
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_light">Inicio <i
                    class="fa-solid fa-house"></i></a>


            <a href="{{ route('erp.producto.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_darkt"><i
                    class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">General</h4>

                    <div class="g_margin_bottom_20">
                        <label for="nombre">Nombre <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" wire:model="producto.nombre">
                        @error('producto.nombre')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="slug">Slug <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="slug" wire:model="producto.slug">
                        @error('producto.slug')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descripcion">Descripción <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="descripcion" wire:model="producto.descripcion" rows="3"></textarea>
                        @error('producto.descripcion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="g_panel">
                    <h4 class="g_panel_titulo">Imagenes</h4>

                    @if ($imagenes_inicial)
                        <ul>
                            @foreach ($imagenes_inicial as $index => $imagen)
                                <li>
                                    <img src="{{ $imagen->url }}" style="max-width: 150px; max-height: 150px;">
                                    <a href="{{ $imagen->url }}" target="_blank">Ver</a>
                                    <button wire:click="eliminarImagen({{ $index }})">Eliminar</button>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">Activo</h4>
                    <select wire:model="producto.activo">
                        <option value="2">DESACTIVADO</option>
                        <option value="1">ACTIVO</option>
                    </select>
                    @error('producto.activo')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div>
            <button wire:click="guardar" class="guardar">Guardar</button>
            <a href="{{ route('erp.producto.vista.todas') }}" class="cancelar">Cancelar</a>
        </div>
    </div>
</div>
