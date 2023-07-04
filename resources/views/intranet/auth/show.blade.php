@extends('intranet.auth.base')

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title text-center text-uppercase">Acceso Usuarios</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('intranet.auth.login') }}" method="POST">
                <div class="text-center py-4">Ingrese su email y contraseña.</div>
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error':'' }}">
                    <input type="email"
                           class="form-control"
                           placeholder="Email"
                           name="email"
                           value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error':'' }}">
                    <input type="password"
                           class="form-control"
                           placeholder="Contraseña"
                           name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group has-feedback {{ $errors->has('error') ? 'has-error':'' }}">
                        <input type="hidden" name="error">
                        {!! $errors->first('error','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="col-xs-6">

                    </div>
                    <div class="col-xs-6" >
                        <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
