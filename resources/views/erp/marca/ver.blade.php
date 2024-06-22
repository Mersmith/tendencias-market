<div>
    <h2>VER MARCA</h2>
    <a href="{{ route('marca.vista.todas') }}">Regresar</a>
    <a href="{{ route('marca.vista.crear') }}">Crear</a>
    <a href="{{ route('marca.vista.editar', $marca->id) }}">Editar</a>

    <br>
    <p>Nombre: {{ $marca->nombre }} </p>
    <p>Descripción: {{ $marca->descripcion }} </p>

    <br>
    <form action="{{ route('marca.eliminar', $marca->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
</div>
