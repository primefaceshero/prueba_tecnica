@extends('intranet.template.base')
@section('title', $config['blade']['viewTitle'])

@if ($config['blade']['showBreadcrumb'])
@section('breadcrumb')
    @foreach($config['breadcrumb'] as $key => $data)
        <li><a href="{{ $data['link'] }}"
               class="{{ count($config['breadcrumb']) == $key + 1 ? 'active' : '' }}">{!!$data['name'] !!}</a></li>
    @endforeach
@endsection
@endif

@section('content')

    <div class="row">
        @foreach($shops as $shop)
            <div class="col-sm-4 col-md-3">
                <!-- Contact Widget -->
                <!---------------------------------->
                <div class="panel pos-rel">
                    <div class="pad-all text-center">
                        <div class="widget-control">
{{--                            <a href="#" class="add-tooltip btn btn-trans" data-original-title="Favorite"><span--}}
{{--                                    class="favorite-color"><i class="demo-psi-star icon-lg"></i></span></a>--}}
{{--                            <div class="btn-group dropdown">--}}
{{--                                <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown"--}}
{{--                                   aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>--}}
{{--                                <ul class="dropdown-menu dropdown-menu-right" style="">--}}
{{--                                    <li><a href="#"><i class="icon-lg icon-fw demo-psi-pen-5"></i> Edit</a></li>--}}
{{--                                    <li><a href="#"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a></li>--}}
{{--                                    <li class="divider"></li>--}}
{{--                                    <li><a href="#"><i class="icon-lg icon-fw demo-pli-mail"></i> Send a Message</a>--}}
{{--                                    </li>--}}
{{--                                    <li><a href="#"><i class="icon-lg icon-fw demo-pli-calendar-4"></i> View Details</a>--}}
{{--                                    </li>--}}
{{--                                    <li><a href="#"><i class="icon-lg icon-fw demo-pli-lock-user"></i> Lock</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                        <a href="#">
                            <img alt="Profile Picture" class="img-lg img-circle mar-ver"
                                 src="{{ env('APP_URL_CDN', '') }}/themes/intranet/img/icon-shop.png">
                            <p class="text-lg text-semibold mar-no text-main">{{ $shop->name }}</p>
                            <p class="text-sm">{{ $shop->domain }}</p>

                            <p class="text-sm font-15">
                                @if($shop->active)
                                    <span class="label label-success "> Activa </span>
                                @else
                                    <span class="label label-danger "> Desactivada </span>
                                @endif
                            </p>
                            <p>
                                <a href="{{ route('intranet.shops.dashboard.index', [$shop->slug]) }}" class="btn btn-primary">Entrar <i class="fa fa-arrow-right"></i></a>
                            </p>
                        </a>
{{--                        <div class="pad-top btn-groups">--}}
{{--                            <a target="_blank" href="#" class="btn btn-icon demo-pli-facebook icon-lg add-tooltip"--}}
{{--                               data-original-title="Facebook" data-container="body"></a>--}}
{{--                            <a target="_blank" href="#" class="btn btn-icon demo-pli-twitter icon-lg add-tooltip"--}}
{{--                               data-original-title="Twitter" data-container="body"></a>--}}
{{--                            <a target="_blank" href="#" class="btn btn-icon demo-pli-instagram icon-lg add-tooltip"--}}
{{--                               data-original-title="Instagram" data-container="body"></a>--}}
{{--                            <a target="_blank" href="/{{ $shop->domain }}" class="btn btn-icon ti-world icon-lg add-tooltip"--}}
{{--                               data-original-title="Web" data-container="body"></a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <!---------------------------------->
            </div>
        @endforeach

    </div>

@endsection

@section('styles')

@endsection

@section('scripts')

    @include('intranet.template.components._crud_script_change_status')
    @include('intranet.template.components._crud_script_active')
    @include('intranet.template.components._crud_script_delete')

@endsection

