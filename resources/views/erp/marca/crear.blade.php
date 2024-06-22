<div>
    <h2>CREAR MARCA</h2>
    <a href="{{ route('marca.vista.todas') }}">Regresar</a>
    
    <form action="{{route('marca.crear')}}" method="POST">
        @csrf
        <p>Nombre:</p>
        <input type="text" name="nombre">
        <br>

        <p>Descripción:</p>
        <textarea name="descripcion"></textarea>
        <br>

        <button type="submit">Enviar</button>
    </form>
</div>
