<ul id="mainnav-menu" class="list-group" style="margin-bottom: 120px;">


    @can('intranet.shops.users.index')
        <li class="list-divider"></li>
        <li class="list-header">ADMINISTRACIÓN</li>
        @can('intranet.shops.roles.index')
            <li class="{{ is_menu_active('intranet/tiendas/'.session('shop')->slug.'/roles') }}">
                <a href="{{ route('intranet.shops.roles.index', [session('shop')->slug]) }}">
                    <i class="ti-lock"></i>
                    <span class="menu-title">Roles de Usuarios</span>
                </a>
            </li>
        @endcan
        @can('intranet.shops.users.index')
            <li class="{{ is_menu_active('intranet/tiendas/'.session('shop')->slug.'/usuarios') }}">
                <a href="{{ route('intranet.shops.users.index', [session('shop')->slug]) }}">
                    <i class="ti-user"></i>
                    <span class="menu-title">Usuarios del Sistema</span>
                </a>
            </li>
        @endcan
    @endcan

</ul>
