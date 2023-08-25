@extends('intranet.template.base')

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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="titulo">Título</label>
                                    <input type="text" id="titulo" name="titulo" class="form-control" required
                                           value="{{ old('titulo') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" id="descripcion" name="descripcion" class="form-control" required
                                           value="{{ old('descripcion') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fechaVencimiento">Fecha de vencimiento</label>
                                    <input type="text" id="fechaVencimiento" name="fechaVencimiento" class="form-control" required
                                           value="{{ old('fechaVencimiento') }}">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="" class="btn btn-default"><i
                                            class="fa fa-chevron-left"></i>Back</a>
                            </div>
                            <div class="col-xs-6 text-right">
                                <button class="btn btn-primary" type="submit"><i
                                            class="fa fa-save"></i> Save</button>
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
