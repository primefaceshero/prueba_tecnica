@extends('intranet.template.base')
@section('title', 'Dashboard')
@section('breadcrumb')
    <li class="active">Panel General</li>
@endsection

@section('content')
    <div class="row">

    </div>
@endsection


@section('styles')
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/chartJS/Chart.min.css" rel="stylesheet">
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/chartJS/Chart.min.css" rel="stylesheet">
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/date-range-picker/daterangepicker.css" rel="stylesheet">

    <style>
        .label-table {
            max-width: 100%;
            width: 100%;
            padding: 5px 12px;
        }
        @if(session('shop') && session('shop')->slug == "prueba")
            .daterangepicker .ranges li.active {
                background-color: #1976d2;
                color: #fff;
            }
            .daterangepicker td.active, .daterangepicker td.active:hover {
                background-color: #1976d2;
                border-color: transparent;
                color: #fff;
            }
        @elseif(session('shop') && session('shop')->slug == "casa-textil")
            .daterangepicker .ranges li.active {
                background-color: #80b343;
                color: #fff;
            }
            .daterangepicker td.active, .daterangepicker td.active:hover {
                background-color: #80b343;
                border-color: transparent;
                color: #fff;
            }
        @else
            .daterangepicker .ranges li.active {
                background-color: #fe6d33;
                color: #fff;
            }
            .daterangepicker td.active, .daterangepicker td.active:hover {
                background-color: #fe6d33;
                border-color: transparent;
                color: #fff;
            }
        @endif
    </style>

@endsection

@section('scripts')
    <!--Bootstrap Table [ OPTIONAL ]-->
    <script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/chartJS/Chart.js"></script>
    <script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/chartJS/Chart.min.js"></script>
    <script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/momentjs/moment.min.js"></script>
    <script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/date-range-picker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-es-CL.js"></script>

@endsection
