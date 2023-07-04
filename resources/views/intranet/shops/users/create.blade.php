@extends('intranet.template.base')
@section('title', $config['blade']['viewTitle'])

@if ($config['blade']['showBreadcrumb'])
    @section('breadcrumb')
        @php(array_push($config['breadcrumb'], ['link'=>'', 'name' => $config['blade']['viewCreate']]))
        @foreach($config['breadcrumb'] as $key => $data)
            <li><a href="{{ $data['link'] }}"
                   class="{{ count($config['breadcrumb']) == $key + 1 ? 'active' : '' }}">{!! $data['name'] !!}</a></li>
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
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-body">
                        @include('intranet.template.components._alerts')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">Nombres (*)</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" required
                                           value="{{ old('first_name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Apellidos (*)</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" required
                                           value="{{ old('last_name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role_id">Rol (*)</label>
                                    <select id="role_id" name="role_id" class="form-control select2" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $role->id == old('role_id') ? 'selected':'' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email (*)</label>
                                    <input type="email" id="email" name="email" class="form-control" required
                                           value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="control-label">Contraseña (*)</label>
                                    <div class="input-group">
                                        <input required id="password" name="password" class="form-control"
                                               autocomplete="off"
                                               value="{{ old('password') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary btn-flat" type="button"
                                                    onclick="generatePassword()">
                                                <i class="fa fa-key"></i> Generar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
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
    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/select2/css/select2.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/select2/js/select2.min.js"></script>

    <script>

        $(".select2").select2({
            tags: false
        });

        /* password generator */
        function generatePassword() {
            var pass = Math.random().toString(36).substring(2);
            $('#password').val(pass);
        }

    </script>
@endsection
