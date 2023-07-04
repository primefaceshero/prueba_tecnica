@extends('intranet.template.base')
@section('title', $config['blade']['viewTitle'])

@if ($config['blade']['showBreadcrumb'])
@section('breadcrumb')
    @php(array_push($config['breadcrumb'], ['link'=>'', 'name' => $config['blade']['viewCreate']]))
    @foreach($config['breadcrumb'] as $key => $data)
        <li><a href="{{ $data['link'] }}"
               class="{{ count($config['breadcrumb']) == $key + 1 ? 'active' : '' }}">{!!$data['name'] !!}</a></li>
    @endforeach
@endsection
@endif

@section('toolbar-buttons')
    <a href="{{route($config['route'] . 'index', [session('shop')->slug])}}" class="btn btn-default"><i
            class="fa fa-chevron-left"></i> {{ $config['blade']['btnBack']}}</a>
    <button class="btn btn-primary" type="button" onclick="doSubmit('form-create')"><i
            class="fa fa-save"></i> {{ $config['blade']['btnSave']}}</button>
@endsection

@section('content')

    <form id="form-create" action="{{ route($config['route'] . 'store', [session('shop')->slug]) }}" enctype="multipart/form-data" method="POST">
        <button type="submit" class="hide"></button>
        @csrf()
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nombre (*)</h3>
                    </div>
                    <div class="panel-body">
                        @include('intranet.template.components._alerts')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{--                                    <label for="name">Nombre (*)</label>--}}
                                    <input type="text" id="name" name="name" class="form-control" required
                                           value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($groups as $key => $group)

                <div class="col-md-4">
                    <div class="panel" style="height:390px !important">
                        <div class="panel-heading">

                            <div class="panel-control">
                                <input class="js-switch all-control" id="{{$key}}" type="checkbox" onchange="change_input(this)" checked>
                            </div>
                            <h3 class="panel-title">{{ $group }}</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group" id="checks_all_{{$key}}">
                                @foreach($permissions->where('public_group', $group) as $permission)

                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-xs-9">
                                                <span class="badge badge-info add-tooltip" data-toggle="tooltip"
                                                      data-container="body" data-placement="top"
                                                      data-original-title="{{ $permission->public_description }}"><i
                                                        class="fa fa-question"></i></span>
                                                &nbsp;{{ $permission->public_name }}
                                            </div>
                                            <div class="col-xs-3">
                                                <div class="right">
                                                    <input class="js-switch {{ $key }}" name="permissions[]"
                                                           value="{{$permission->id}}" type="checkbox" checked>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="{{route($config['route'] . 'index', [session('shop')->slug])}}" class="btn btn-default"><i
                                        class="fa fa-chevron-left"></i> {{ $config['blade']['btnBack']}}</a>
                            </div>
                            <div class="col-xs-6 text-right">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-save"></i> {{ $config['blade']['btnSave']}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('styles')
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/switchery/switchery.min.css" rel="stylesheet">
@endsection

@section('scripts')

    <script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/switchery/switchery.min.js"></script>
    <script>
        $(document).ready(function () {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            elems.forEach(function (html) {
                let switchery = new Switchery(html);
            });
        });
    </script>

    <script>

        $("#table-bs").on('ready', function () {
           filter();
        }).change(function() {
            filter();
        });

        function filter(){
            $(".filtro").on('focus', function () {
                previous = this.value;
            }).change(function() {
                header_change(this, previous);
            });
        }

        function change_input(element){
            var id = $(element).attr('id');
            if($(element).is(':checked') ){
                $("."+id).each(function () {
                    if(!$(this).is(':checked') ){
                        $(this).trigger("click");
                    }
                });

            } else {
                $("."+id).each(function () {
                    if($(this).is(':checked') ){
                        $(this).trigger("click");
                    }
                });
            }
        }


    </script>
@endsection
