<div class="g_padding_20">
    <h4 class="g_panel_titulo">Imagenes</h4>

    @if ($imagenes->count())
        <div class="grid_instagram g_margin_bottom_20">
            @foreach ($imagenes as $imagen)
                <div
                    class="item {{ collect($imagenes_seleccionadas)->contains('id', $imagen->id) ? 'imagene_seleccionada' : '' }}">
                    <div class="contenedor_imagen">
                        <img src="{{ $imagen->url }}" alt="{{ $imagen->titulo }}" class="imagen">
                    </div>

                    <div class="botones">
                        <button wire:click="seleccionarImagen({{ $imagen->id }})" class="g_boton g_boton_danger">
                            {{ collect($imagenes_seleccionadas)->contains('id', $imagen->id) ? 'Seleccionado' : 'Elegir' }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($imagenes->hasPages())
            <div class="g_margin_bottom_20">
                {{ $imagenes->onEachSide(1)->links() }}
            </div>
        @endif
    @else
        <div class="g_vacio">
            <p>No hay elementos.</p>
            <i class="fa-regular fa-face-grin-wink"></i>
        </div>
    @endif

    <div>
        <div class="formulario_botones">
            <button wire:click="enviar" class="guardar">Enviar imágenes</button>
        </div>
    </div>
</div>