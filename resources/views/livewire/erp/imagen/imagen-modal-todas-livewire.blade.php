<div>
    <style>
        .estilo_ga {
            display: flex;
            flex-wrap: wrap;
        }

        .imagen-item {
            margin: 10px;
            text-align: center;
            cursor: pointer;
        }

        .seleccionada {
            border: 2px solid green;
            /* Cambia el estilo como desees */
        }
    </style>

    <h2>Todas las imágenes</h2>

    <ul class="estilo_ga">
        @foreach ($imagenes as $imagen)
            <li class="imagen-item {{ collect($imagenes_seleccionadas)->contains('id', $imagen->id) ? 'seleccionada' : '' }}">
                <strong>{{ $imagen->titulo }}</strong>
                <img src="{{ $imagen->url }}" alt="{{ $imagen->titulo }}" style="max-width: 150px; max-height: 150px;">
                <a href="{{ $imagen->url }}" target="_blank">Ver</a>
                <button wire:click="seleccionarImagen({{ $imagen->id }})">
                    {{ collect($imagenes_seleccionadas)->contains('id', $imagen->id) ? 'Des seleccionar' : 'Seleccionar' }}
                </button>
            </li>
        @endforeach
    </ul>

    <button type="button" wire:click="enviar">Enviar Imágenes</button>
</div>
