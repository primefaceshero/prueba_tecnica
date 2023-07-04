@extends('intranet.template.base')
@section('title', $config['blade']['viewTitle'])

@if ($config['blade']['showBreadcrumb'])
@section('breadcrumb')
    @php(array_push($config['breadcrumb'], ['link'=>'', 'name' =>  $config['blade']['viewPermission']]))
    @foreach($config['breadcrumb'] as $key => $data)
        <li><a href="{{ $data['link'] }}"
            class="{{ count($config['breadcrumb']) == $key + 1 ? 'active' : '' }}">{!! $data['name'] !!}</a></li>
    @endforeach
@endsection
@endif

@section('toolbar-buttons')
    <a href="{{route($config['route'] . 'index', [session('shop')->slug])}}" class="btn btn-default"><i
            class="fa fa-chevron-left"></i> {{ $config['blade']['btnBack']}}</a>
    <button class="btn btn-primary" type="button" onclick="doSubmit('form-edit')"><i
            class="fa fa-save"></i> {{ $config['blade']['btnUpdate']}}</button>
@endsection

@section('content')
    <form id="form-edit" action="{{ route($config['route'] . 'permissionsUpdate', [session('shop')->slug, $object->id]) }}"
          enctype="multipart/form-data" method="POST">

        <button type="submit" class="hide"></button>
        <input type="hidden" name="_method" value="PUT">
        @csrf()
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        @include('intranet.template.components._alerts')
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <span class="semibold">{{ $object->full_name }}</span> -
                                    @foreach ($object->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <i class="fa fa-question-circle-o"></i> A continuación puede dar permisos
                                    especificos al usuario, estos permisos sobre escribirán los permisos del Rol asignado,
                                    aparacerá este icono <i class="fa fa-check fa-1x text-success"></i> si el permiso
                                    esta asignado también en el rol del usuario y este otro <i class="fa fa-times fa-1x text-danger"></i>
                                    si el rol no cuenta con el permiso.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @foreach($groups as $key => $group)

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-heading">

                            <div class="panel-control">
                                {{--                                <input class="js-switch all-control" id="all_{{$key}}" type="checkbox" checked>--}}
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
                                                    <div>
                                                        <input class="js-switch" name="permissions[]"
                                                               value="{{$permission->id}}"
                                                               id="check_{{$permission->id}}"
                                                               type="checkbox" style="display: none;">
                                                        <div class="pl-3 float-right" id="per_role_{{$permission->id}}">
                                                            <i class="fa fa-times text-danger"></i>
                                                        </div>
                                                    </div>


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
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="{{route($config['route'] . 'index', [session('shop')->slug])}}" class="btn btn-default"><i
                                    class="fa fa-chevron-left"></i> {{ $config['blade']['btnBack']}}</a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button class="btn btn-primary" type="submit"><i
                                    class="fa fa-save"></i> {{ $config['blade']['btnUpdate']}}</button>
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

            let user = @json($object->permissions->pluck('id'));
            user.forEach(function (rol) {
                $('#check_' + rol).attr('checked', 'checked');
            });

            let roles = @json($object->roles);
            roles.forEach(function (rol) {
                rol.permissions.forEach(function (permission) {
                    $('#per_role_' + permission.id).html('<i class="fa fa-check text-success"></i>');
                    $('#check_' + permission.id).remove();
                });
            });


            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            elems.forEach(function (html) {
                let switchery = new Switchery(html);
            });
        });
    </script>

@endsection

