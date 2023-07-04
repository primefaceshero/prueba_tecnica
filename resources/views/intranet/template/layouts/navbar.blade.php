<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="{{ route('intranet.shops.index', [session('shop')->slug]) }}" class="navbar-brand">
                <img src="{{ env('APP_URL_CDN', '') }}/themes/intranet/img/logo.png" alt="Intranet Logo" class="brand-icon">
                <div class="brand-title">
                    <span class="brand-text">Intranet</span>
                </div>
            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->


        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content">
            <ul class="nav navbar-top-links">

                <!--Navigation toggle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#">
                        <i class="demo-pli-list-view"></i>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toggle button-->

            </ul>
            <ul class="nav navbar-top-links">

                <!--Config dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                @can('intranet.shops.users.index')
                <li id="dropdown-config" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class=" pull-right">
                                    <i class="demo-pli-gear icon-lg icon-fw"></i>
                                </span>
                    </a>


                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                        <ul class="head-list">
                            @can('intranet.shops.users.index')
                                <li>
                                    <a href="{{ route('intranet.shops.users.index', [session('shop')->slug]) }}">
                                        <i class="ti-user"></i>
                                        <span class="menu-title">Usuarios del Sistema</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End config dropdown-->

                <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="ic-user pull-right">
                                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                    <!--You can use an image instead of an icon.-->
                                    <!--<img class="img-circle img-user media-object" src="img/profile-photos/1.png" alt="Profile Picture">-->
                                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                    <i class="demo-pli-male"></i>
                                </span>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--You can also display a user name in the navbar.-->
                        <!--<div class="username hidden-xs">Aaron Chavez</div>-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    </a>


                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                        <ul class="head-list">
                            <li>
                                <a href="{{ route('intranet.shops.profile.index', [session('shop')->slug]) }}"><i class="demo-pli-male icon-lg icon-fw"></i> Perfil</a>
                            </li>
                            {{--<li>--}}
                            {{--<a href="#"><span class="badge badge-danger pull-right">9</span><i class="demo-pli-mail icon-lg icon-fw"></i> Messages</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#"><span class="label label-success pull-right">New</span><i class="demo-pli-gear icon-lg icon-fw"></i> Settings</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#"><i class="demo-pli-computer-secure icon-lg icon-fw"></i> Lock screen</a>--}}
                            {{--</li>--}}
                            <li>
                                <a href="{{ route('intranet.auth.logout') }}"><i
                                        class="demo-pli-unlock icon-lg icon-fw"></i> Salir</a>
                            </li>
                        </ul>
                    </div>
                </li>


            </ul>
        </div>

    </div>
</header>
