<div class="detalle_carrito">

    <!-- CARRITO -->
    <div class="carrito">
        <div>
            <h2 class="titulo">Carrito de compras ({{ $carritoCantidadItems }})</h2>
        </div>

        <div class="separacion"> </div>

        <div>
            @if ($carrito && $carrito->detalle->count() > 0)
                <div>
                    @foreach ($carrito->detalle as $detalle)
                        <div class="item_producto">
                            <div class="info_producto">
                                <div class="contenedor_imagen">
                                    <img style="width: 100px;" src="{{ $detalle->imagen_url }}" alt="">
                                </div>
                                <div class="contenedor_informacion">
                                    <h3 class="producto_nombre"> {{ $detalle->producto_nombre }}</h3>
                                    <h4 class="marca_nombre">{{ $detalle->marca_nombre }}</h4>

                                    <p>cantidad: {{ $detalle->cantidad }}</p>

                                    @if ($detalle->color_nombre)
                                        <p class="variacion">Color:
                                            <span>{{ $detalle->color_nombre }}</span>
                                        </p>
                                    @endif

                                    @if ($detalle->talla_nombre)
                                        <p class="variacion">Talla:
                                            <span>{{ $detalle->talla_nombre }}</span>
                                        </p>
                                    @endif

                                    @if ($detalle->precio_oferta)
                                        <p class="precio precio_oferta">S/.
                                            {{ number_format($detalle->precio_oferta, 2) }}</p>
                                    @endif

                                    <p class="precio precio_normal">
                                        S/. {{ number_format($detalle->precio_normal, 2) }}
                                        @if ($detalle->porcentaje_descuento)
                                            <span class="descuento">
                                                - {{ $detalle->porcentaje_descuento }}%
                                            </span>
                                        @endif
                                    </p>
                                    <p class="precio precio_antiguo">S/.
                                        {{ number_format($detalle->precio_antiguo, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="separacion"> </div>
                    @endforeach
                </div>
            @else
                <p>Tu carrito está vacío.</p>
            @endif
        </div>
    </div>

    <!-- RESUMEN PAGO -->
    <div class="resumen_pago">
        <div class="detalle_pago">
            <div>
                <h2 class="titulo">Resumen de tu pedido</h2>
            </div>

            <div class="separacion"> </div>

            <div class="monto">
                <p class="texto">Descuento por promo:</p>
                <span class="numero">- S/. {{ number_format($carritoTotalDescuento, 2) }}</span>
            </div>

            <div class="monto">
                <p class="texto">Subtotal:</p>
                <span class="numero"> S/. {{ number_format($carritoTotalGeneral, 2) }}</span>
            </div>

            <div class="separacion"> </div>

            @if ($carritoCantidadItems == 1)
                @if ($cupon_tipo)
                    <div class="monto">
                        <p class="texto">
                            Cupón descuento: {{ $cupon_tipo }}
                            @if ($cupon_tipo == 'FIJO')
                                S/. {{ number_format($cupon_descuento, 2) }}
                            @else
                                % {{ $cupon_descuento }}
                            @endif
                        </p>

                        <span class="numero">- S/. {{ number_format($cuponTotalDescuento, 2) }}</span>
                    </div>
                @endif

                <!-- INPUT Y BOTONES DE CUPÓN -->
                <div class="cupon">
                    <input type="text" wire:model="cupon_codigo" placeholder="Ingresa tu código de cupón" />
                    <button wire:click="aplicarCupon" class="aplicar_cupon">Aplicar cupón</button>
                    <button wire:click="eliminarCupon" class="eliminar_cupon">Eliminar cupón</button>

                    @if ($cupon_mensaje)
                        <p class="mensaje_cupon">{{ $cupon_mensaje }}</p>
                    @endif
                </div>
            @endif

            @if ($direccionEnvio)
                <div class="monto">
                    <p class="texto">Delivery:</p>
                    <span class="numero"> S/. {{ number_format($deliveryTotalCosto, 2) }}</span>
                </div>
            @endif

            <div class="monto">
                <p class="texto">Total a pagar:</p>
                <span class="numero"> S/. {{ number_format($total_a_pagar, 2) }}</span>
            </div>

            <a href="{{ route('comprador.pagar.vista.ver') }}" class="continuar_compra">
                Pagar
            </a>
        </div>

        <div>
            @if ($direccionEnvio)
                <div class="direccionEnvio-item">
                    <h3>{{ $direccionEnvio->recibe_nombres }}</h3>
                    <p>Teléfono: {{ $direccionEnvio->recibe_celular }}</p>
                    <p>Dirección: {{ $direccionEnvio->direccionEnvio }}
                        {{ $direccionEnvio->direccion_numero }}</p>
                    <p>
                        {{ $direccionEnvio->departamento->nombre }} /
                        {{ $direccionEnvio->provincia->nombre }} /
                        {{ $direccionEnvio->distrito->nombre }}</p>
                    <p>Código Postal: {{ $direccionEnvio->codigo_postal }}</p>
                    @if ($direccionEnvio->es_principal)
                        <p><strong>Dirección principal</strong></p>
                    @endif

                    <div>
                        <button wire:click="abrirModalSeleccionarDireccion()">CAMBIAR DIRECCION</button>
                    </div>
                </div>
            @else
                <p>No tienes direcciones registradas.</p>
            @endif
            <br>

            <!-- Modal de seleccionadri dirección -->
            @if ($modalSeleccionarDireccion)
                <div class="modal">
                    <div class="modal-content">
                        <h3>Direcciones</h3>
                        <button wire:click="abrirModalCrearDireccion()">Agregar Nueva Dirección</button>

                        <div>
                            @if ($direcciones->isEmpty())
                                <p>No tienes direcciones registradas.</p>
                            @else
                                @foreach ($direcciones as $direccion)
                                    <div class="direccion-item">
                                        <h3>{{ $direccion->recibe_nombres }}</h3>
                                        <p>Teléfono: {{ $direccion->recibe_celular }}</p>
                                        <p>Dirección: {{ $direccion->direccion }} {{ $direccion->direccion_numero }}
                                        </p>
                                        <p>
                                            {{ $direccion->departamento->nombre }} /
                                            {{ $direccion->provincia->nombre }} /
                                            {{ $direccion->distrito->nombre }}</p>
                                        <p>Código Postal: {{ $direccion->codigo_postal }}</p>
                                        @if ($direccion->es_principal)
                                            <p><strong>Dirección principal</strong></p>
                                        @endif
                                        <!-- Botón para seleccionar esta dirección -->
                                        <button wire:click="seleccionarDireccion({{ $direccion->id }})">Seleccionar
                                            esta dirección</button>

                                        <button wire:click="editarDireccion({{ $direccion->id }})">Editar
                                            esta dirección</button>
                                    </div>
                                    <br>
                                @endforeach
                            @endif
                        </div>

                        <button wire:click="$set('modalSeleccionarDireccion', false)">Cancelar</button>
                    </div>
                </div>
            @endif

            <!-- Modal de edición dirección -->
            @if ($modalEditarDireccion)
                <div class="modal">
                    <div class="modal-content">
                        <h3>Editar Dirección</h3>

                        <input type="text" wire:model.live="recibe_nombres">
                        <input type="text" wire:model.live="recibe_celular">
                        <input type="text" wire:model.live="direccion">
                        <input type="text" wire:model.live="direccion_numero">
                        <input type="text" wire:model.live="codigo_postal">

                        <select wire:model.live="departamento_id">
                            <option value="">Selecciona un Departamento</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                            @endforeach
                        </select>

                        <select wire:model.live="provincia_id">
                            <option value="">Selecciona una Provincia</option>
                            @foreach ($provincias as $provincia)
                                <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                            @endforeach
                        </select>

                        <select wire:model.live="distrito_id">
                            <option value="">Selecciona un Distrito</option>
                            @foreach ($distritos as $distrito)
                                <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                            @endforeach
                        </select>

                        <button wire:click="updateDireccion">Guardar Cambios</button>
                        <button wire:click="$set('modalEditarDireccion', false)">Cancelar</button>
                    </div>
                </div>
            @endif

            @if ($modalCrearDireccion)
                <div class="modal">
                    <div class="modal-content">
                        <h3>Nueva Dirección</h3>

                        <input type="text" wire:model.live="recibe_nombres" placeholder="Nombres">
                        <input type="text" wire:model.live="recibe_celular" placeholder="Celular">
                        <input type="text" wire:model.live="direccion" placeholder="Dirección">
                        <input type="text" wire:model.live="direccion_numero" placeholder="Número de Dirección">
                        <input type="text" wire:model.live="codigo_postal" placeholder="Código Postal">

                        <select wire:model.live="departamento_id">
                            <option value="">Selecciona un Departamento</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                            @endforeach
                        </select>

                        <select wire:model.live="provincia_id">
                            <option value="">Selecciona una Provincia</option>
                            @foreach ($provincias as $provincia)
                                <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                            @endforeach
                        </select>

                        <select wire:model.live="distrito_id">
                            <option value="">Selecciona un Distrito</option>
                            @foreach ($distritos as $distrito)
                                <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                            @endforeach
                        </select>

                        <button wire:click="createDireccion">Guardar Dirección</button>
                        <button wire:click="$set('modalCrearDireccion', false)">Cancelar</button>
                    </div>
                </div>
            @endif

        </div>
    </div>


</div>
