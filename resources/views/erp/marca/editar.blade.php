<div>
    <h2>EDITAR MARCA</h2>
    <a href="{{ route('marca.vista.todas') }}">Regresar</a>
    <a href="{{ route('marca.vista.crear') }}">Crear</a>
    <a href="{{ route('marca.vista.editar', $marca->id) }}">Editar</a>
    <br>
    <form action="{{ route('marca.editar', $marca->id) }}" method="POST">
        @csrf
        @method('PUT')
        <p>Nombre:</p>
        <input type="text" name="nombre" value="{{ $marca->nombre }}">
        <br>

        <p>Descripción:</p>
        <textarea name="descripcion">{{ $marca->descripcion }}</textarea>
        <br>

        <button type="submit">Enviar</button>
    </form>
</div>
