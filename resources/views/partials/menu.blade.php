@php
    $json_menu = file_get_contents('erp-menu-principal.json');
    $menuPrincipal = collect(json_decode($json_menu, true));

    $currentRoute = parse_url(url()->current(), PHP_URL_PATH);

    $seleccionadoNivel_1 = null;
    $seleccionadoNivel_2 = null;
    $seleccionadoNivel_3 = null;
    $seleccionadoNivel_4 = null;

    foreach ($menuPrincipal as $dataNivel_1) {
        if ($dataNivel_1['url'] === $currentRoute) {
            $seleccionadoNivel_1 = $dataNivel_1['id'];
        }
        
        foreach ($dataNivel_1['submenus'] as $dataNivel_2) {
            if ($dataNivel_2['url'] === $currentRoute) {
                $seleccionadoNivel_1 = $dataNivel_1['id'];
                $seleccionadoNivel_2 = $dataNivel_2['id'];
            }

            foreach ($dataNivel_2['submenus'] as $dataNivel_3) {
                if ($dataNivel_3['url'] === $currentRoute) {
                    $seleccionadoNivel_1 = $dataNivel_1['id'];
                    $seleccionadoNivel_2 = $dataNivel_2['id'];
                    $seleccionadoNivel_3 = $dataNivel_3['id'];
                }

                foreach ($dataNivel_3['submenus'] as $dataNivel_4) {
                if ($dataNivel_4['url'] === $currentRoute) {
                    $seleccionadoNivel_1 = $dataNivel_1['id'];
                    $seleccionadoNivel_2 = $dataNivel_2['id'];
                    $seleccionadoNivel_3 = $dataNivel_3['id'];
                    $seleccionadoNivel_4 = $dataNivel_4['id'];
                }
            }
            }
        }
    }
@endphp

<style>
    aside {
        display: flex;
        width: 100%;
    }

    nav {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    nav li {
        margin-left: 15px;
        margin-bottom: 15px;
    }

    .hidden {
        display: none !important;
    }

    .active {
        /* Estilos para el elemento activo */
        font-weight: bold;
        color: red; /* Cambia a tu preferencia */
    }
</style>
<aside x-data="erpMenuPrincipal()" x-cloak x-on:click.away="resetMenu()">
    <div>
        <!--NIVEL 1-->    
        <ul>
            @foreach ($menuPrincipal as $dataNivel_1)
                <li>
                    <a @click="toogleNivel_1($event, {{ $dataNivel_1['id'] }})" :class="{ 'active': seleccionadoNivel_1 === {{ $dataNivel_1['id'] }} }"
                        @if (!count($dataNivel_1['submenus']) > 0) href="{{ route($dataNivel_1['ruta']) }}" @endif>
                        {{ $dataNivel_1['nombre'] }}
                        @if (count($dataNivel_1['submenus']) > 0)
                            <i class="fa-solid fa-sort-down"></i>
                        @endif 
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <nav>
        <!--NIVEL 1-->    
        <ul>
            @foreach ($menuPrincipal as $dataNivel_1)
                <li>
                    <a @click="toogleNivel_1($event, {{ $dataNivel_1['id'] }})" :class="{ 'active': seleccionadoNivel_1 === {{ $dataNivel_1['id'] }} }"
                        @if (!count($dataNivel_1['submenus']) > 0) href="{{ route($dataNivel_1['ruta']) }}" @endif>
                        {{ $dataNivel_1['nombre'] }}
                        @if (count($dataNivel_1['submenus']) > 0)
                            <i class="fa-solid fa-sort-down"></i>
                        @endif 
                    </a>
                    @if (count($dataNivel_1['submenus']) > 0)
                    <!--NIVEL 2-->
                    <ul :class="{ 'hidden': seleccionadoNivel_1 !== {{ $dataNivel_1['id'] }} }">
                        @foreach ($dataNivel_1['submenus'] as $dataNivel_2)
                            <li>
                                <a @click.stop="toogleNivel_2($event, {{ $dataNivel_2['id'] }})"
                                    :class="{ 'active': seleccionadoNivel_2 === {{ $dataNivel_2['id'] }} }"
                                    @if (!count($dataNivel_2['submenus']) > 0) href="{{ route($dataNivel_2['ruta']) }}" @endif>
                                    {{ $dataNivel_2['nombre'] }}
                                    @if (count($dataNivel_2['submenus']) > 0)
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif 
                                </a>

                                @if (count($dataNivel_2['submenus']) > 0)
                                    <!--NIVEL 3-->
                                    <ul :class="{ 'hidden': seleccionadoNivel_2 !== {{ $dataNivel_2['id'] }} }">
                                        @foreach ($dataNivel_2['submenus'] as $dataNivel_3)
                                            <li>
                                                <a @click.stop="toogleNivel_3($event, {{ $dataNivel_3['id'] }})"
                                                    :class="{ 'active': seleccionadoNivel_3 === {{ $dataNivel_3['id'] }} }"
                                                    @if (!count($dataNivel_3['submenus']) > 0) href="{{ route($dataNivel_3['ruta']) }}" @endif>
                                                    {{ $dataNivel_3['nombre'] }}
                                                    @if (count($dataNivel_3['submenus']) > 0)
                                                        <i class="fa-solid fa-sort-down"></i>
                                                    @endif 
                                                </a>

                                                @if (count($dataNivel_3['submenus']) > 0)
                                                    <!--NIVEL 4-->
                                                    <ul :class="{ 'hidden': seleccionadoNivel_3 !== {{ $dataNivel_3['id'] }} }">
                                                        @foreach ($dataNivel_3['submenus'] as $dataNivel_4)
                                                            <li>
                                                                <a @click.stop="toogleNivel_4($event, {{ $dataNivel_4['id'] }})"
                                                                    :class="{ 'active': seleccionadoNivel_4 === {{ $dataNivel_4['id'] }} }"
                                                                    @if (!count($dataNivel_4['submenus']) > 0) href="{{ route($dataNivel_4['ruta']) }}" @endif>
                                                                    {{ $dataNivel_4['nombre'] }}
                                                                    @if (count($dataNivel_4['submenus']) > 0)
                                                                        <i class="fa-solid fa-sort-down"></i>
                                                                    @endif                                                                
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</aside>
<script>
    function erpMenuPrincipal() {
        return {
            seleccionadoNivel_1: {{ json_encode($seleccionadoNivel_1) }},
            seleccionadoNivel_2: {{ json_encode($seleccionadoNivel_2) }},
            seleccionadoNivel_3: {{ json_encode($seleccionadoNivel_3) }},
            seleccionadoNivel_4: {{ json_encode($seleccionadoNivel_4) }},

            toogleNivel_1(event, id) {
                if (this.seleccionadoNivel_1 === id) {
                    this.seleccionadoNivel_1 = null;
                } else {
                    this.seleccionadoNivel_1 = id;
                }
                this.seleccionadoNivel_2 = null;
                this.seleccionadoNivel_3 = null;
                this.seleccionadoNivel_4 = null;
            },
            toogleNivel_2(event, id) {
                if (this.seleccionadoNivel_2 === id) {
                    this.seleccionadoNivel_2 = null;
                } else {
                    this.seleccionadoNivel_2 = id;
                }
                this.seleccionadoNivel_3 = null;
                this.seleccionadoNivel_4 = null;
            },
            toogleNivel_3(event, id) {
                if (this.seleccionadoNivel_3 === id) {
                    this.seleccionadoNivel_3 = null;
                } else {
                    this.seleccionadoNivel_3 = id;
                }
                this.seleccionadoNivel_4 = null;
            },
            toogleNivel_4(event, id) {
                if (this.seleccionadoNivel_4 === id) {
                    this.seleccionadoNivel_4 = null;
                } else {
                    this.seleccionadoNivel_4 = id;
                }
            },
            resetMenu() {
                this.seleccionadoNivel_1 = null;
                this.seleccionadoNivel_2 = null;
                this.seleccionadoNivel_3 = null;
                this.seleccionadoNivel_4 = null;
            }
        };
    }
</script>