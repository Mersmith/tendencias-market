<div class="comprador_menu_pricipal">
    <a href="{{ route('comprador.perfil.vista.ver') }}"
        class="{{ request()->routeIs('comprador.perfil.vista.ver') ? 'active' : '' }}">
        <span><i class="fa-solid fa-address-card"></i>Perfil</span>
        <i class="fa-solid fa-chevron-right"></i>
    </a>

    <a href="{{ route('comprador.compra.vista.ver') }}"
        class="{{ request()->routeIs('comprador.compra.vista.ver') ? 'active' : '' }}">
        <span><i class="fa-solid fa-basket-shopping"></i> Mis compras</span>
        <i class="fa-solid fa-chevron-right"></i>
    </a>

    <a href="{{ route('comprador.direccion.vista.ver') }}"
        class="{{ request()->routeIs('comprador.direccion.vista.ver') ? 'active' : '' }}">
        <span><i class="fa-solid fa-map-location"></i> Direcciones</span>
        <i class="fa-solid fa-chevron-right"></i>
    </a>

    <a href="{{ route('comprador.reembolso.vista.ver') }}"
        class="{{ request()->routeIs('comprador.reembolso.vista.ver') ? 'active' : '' }}">
        <span><i class="fa-solid fa-arrow-rotate-left"></i> Reembolso</span>
        <i class="fa-solid fa-chevron-right"></i>
    </a>

    <a href="{{ route('comprador.favorito.vista.ver') }}"
        class="{{ request()->routeIs('comprador.favorito.vista.ver') ? 'active' : '' }}">
        <span><i class="fa-solid fa-heart"></i> Favoritos</span>
        <i class="fa-solid fa-chevron-right"></i>
    </a>

    <form method="POST" action="{{ route('logout') }}" x-data>
        @csrf
        <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
            <span><i class="fa-solid fa-power-off"></i> Cerrar</span>
        </a>
    </form>
</div>
