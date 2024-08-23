<div class="comprador_menu_pricipal">
    <a href="{{ route('comprador.perfil.vista.ver') }}">Perfil</a>
    <a href="">Mis compras</a>
    <a href="">Configurar mi cuenta</a>
    <a href="">Direcciones</a>
    <a href="">Reembolso</a>
    <a href="">Favoritos</a>
    <form method="POST" action="{{ route('logout') }}" x-data>
        @csrf
        <a href="{{ route('logout') }}" @click.prevent="$root.submit();">Cerrar</a>
    </form>
</div>
