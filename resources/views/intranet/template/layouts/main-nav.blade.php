<nav id="mainnav-container">
    <div id="mainnav">


        <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
        <!--It will only appear on small screen devices.-->
        <!--================================
        <div class="mainnav-brand">
            <a href="index.html" class="brand">
                <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
                <span class="brand-text">Nifty</span>
            </a>
            <a href="#" class="mainnav-toggle"><i class="pci-cross pci-circle icon-lg"></i></a>
        </div>
        -->


        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <!--Profile Widget-->
                    <!--================================-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <img class="img-circle img-md" src="{{ env('APP_URL_CDN', '') }}/themes/intranet/img/user-default.png"
                                     alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                <p class="mnp-name">{{ auth()->guard('intranet')->user()->full_name }}</p>
                                <span class="mnp-desc">{{ auth()->guard('intranet')->user()->email }}</span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="{{ route('intranet.shops.profile.index', [session('shop')->slug]) }}" class="list-group-item">
                                <i class="demo-pli-male icon-lg icon-fw"></i> Ver Perfil
                            </a>
                            {{--<a href="#" class="list-group-item">--}}
                            {{--<i class="demo-pli-gear icon-lg icon-fw"></i> Configuraciones--}}
                            {{--</a>--}}
                            {{--<a href="#" class="list-group-item">--}}
                            {{--<i class="demo-pli-information icon-lg icon-fw"></i> Ayuda--}}
                            {{--</a>--}}
                            <a href="{{ route('intranet.auth.logout') }}" class="list-group-item">
                                <i class="demo-pli-unlock icon-lg icon-fw"></i> Salir
                            </a>
                        </div>
                    </div>


                {{--<div id="mainnav-shortcut" class="hidden">--}}
                {{--<ul class="list-unstyled shortcut-wrap">--}}
                {{--<li class="col-xs-3" data-content="My Profile">--}}
                {{--<a class="shortcut-grid" href="#">--}}
                {{--<div class="icon-wrap icon-wrap-sm icon-circle bg-mint">--}}
                {{--<i class="demo-pli-male"></i>--}}
                {{--</div>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li class="col-xs-3" data-content="Messages">--}}
                {{--<a class="shortcut-grid" href="#">--}}
                {{--<div class="icon-wrap icon-wrap-sm icon-circle bg-warning">--}}
                {{--<i class="demo-pli-speech-bubble-3"></i>--}}
                {{--</div>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li class="col-xs-3" data-content="Activity">--}}
                {{--<a class="shortcut-grid" href="#">--}}
                {{--<div class="icon-wrap icon-wrap-sm icon-circle bg-success">--}}
                {{--<i class="demo-pli-thunder"></i>--}}
                {{--</div>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li class="col-xs-3" data-content="Lock Screen">--}}
                {{--<a class="shortcut-grid" href="#">--}}
                {{--<div class="icon-wrap icon-wrap-sm icon-circle bg-purple">--}}
                {{--<i class="demo-pli-lock-2"></i>--}}
                {{--</div>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                <!--================================-->
                    <!--End shortcut buttons-->

                    @if(session('shop'))
                        @include('intranet.template.layouts.menus._shop-menu')
                    @else
                        @include('intranet.template.layouts.menus._global-menu')
                    @endif

                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
