<div>
    <div>
        @if ($direcciones->isEmpty())
            <p>No tienes direcciones registradas.</p>
        @else
            @foreach ($direcciones as $direccion)
                <div class="direccion-item">
                    <h3>{{ $direccion->recibe_nombres }}</h3>
                    <p>Teléfono: {{ $direccion->recibe_celular }}</p>
                    <p>Dirección: {{ $direccion->direccion }} {{ $direccion->direccion_numero }}</p>
                    <p>{{ $direccion->distrito->nombre }}, {{ $direccion->provincia->nombre }},
                        {{ $direccion->departamento->nombre }}</p>
                    <p>Código Postal: {{ $direccion->codigo_postal }}</p>
                    @if ($direccion->es_principal)
                        <p><strong>Dirección principal</strong></p>
                    @endif

                    <div>
                        <button>EDITAR</button>
                        <button>Eliminar</button>
                    </div>
                </div>
                <br>
            @endforeach
        @endif
    </div>

</div>
