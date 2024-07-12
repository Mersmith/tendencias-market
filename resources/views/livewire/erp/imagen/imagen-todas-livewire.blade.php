
<div>
    <style>
        .estilo_dropzone {
            border: 2px dashed #007bff;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
    
         .estilo_dropzone:hover {
            background-color: #f1f1f1;
        }
    
        .estilo_dropzone img {
            max-width: 150px;
            max-height: 150px;
            margin: 10px;
        }
    
       .estilo_dropzone div {
            display: inline-block;
            position: relative;
        }
    
        .estilo_dropzone button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            padding: 5px 10px;
            font-size: 14px;
        }
    </style>
    
    <h1>Gestor de Imágenes</h1>

    <form wire:submit.prevent="{{ $imagenId ? 'update' : 'store' }}">
        <input type="text" wire:model="name" placeholder="Nombre" required>


        <input type="text" wire:model="type" placeholder="Tipo" required>


        <div class="estilo_dropzone">
            <label for="photos" style="cursor: pointer;">Subir Imágenes</label>
            <input type="file" id="photos" wire:model="photos" multiple required accept="image/*"
                style="display: none;">

            @if ($photos)
                @foreach ($photos as $index => $photo)
                    <div>
                        <img src="{{ $photo->temporaryUrl() }}" style="max-width: 150px; max-height: 150px;">
                        <button type="button" wire:click="removePhoto({{ $index }})">x</button>
                    </div>
                @endforeach
            @endif
        </div>

        <button type="submit">{{ $imagenId ? 'Actualizar' : 'Guardar' }}</button>

    </form>

    <h2>Lista de Imágenes</h2>
    <ul>
        @foreach ($imagenes as $imagen)
            <li>
                <strong>{{ $imagen->name }}</strong>
                <img src="{{ $imagen->url }}" alt="{{ $imagen->name }}" style="max-width: 150px; max-height: 150px;">
                <a href="{{ $imagen->url }}" target="_blank">Ver</a>
                <button wire:click="edit({{ $imagen->id }})">Editar</button>
                <button wire:click="delete({{ $imagen->id }})">Eliminar</button>
            </li>
        @endforeach
    </ul>
</div>
