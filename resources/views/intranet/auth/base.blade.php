<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{  env('INTRANET_NAME', 'Intranet') }} | @yield('title', 'Login')</title>

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/css/bootstrap.min.css" rel="stylesheet">

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!--Themify Icons [ OPTIONAL ]-->
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/themify-icons/themify-icons.min.css" rel="stylesheet">

    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/css/nifty.min.css" rel="stylesheet">

    <!--SweetAlert [ OPTIONAL ]-->
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/sweet-alert/sweetalert2.min.css" rel="stylesheet">

    <!--Toast [ OPTIONAL ]-->
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!--Toast [ OPTIONAL ]-->
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/select2/css/select2.min.css" rel="stylesheet">

    <!--Bootstrap toggle [ OPTIONAL ]-->
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/bootstrap-toggle/bootstrap-toggle.min.css" rel="stylesheet">

    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    @include('intranet.template.components.theme')

    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/css/custom.css" rel="stylesheet">

    <style>
        .btn:not(.disabled):not(:disabled):hover {
             box-shadow: none;
        }
    </style>

    @yield('styles')

</head>

<body>

@include('intranet.template.components.loading')

<div id="container" class="">
    <div style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <div style="min-width: 300px;padding: 10px;max-width: 400px;width: 100%;">
            <div class="px-5 pb-5">
                <img src="https://www.innovaweb.cl/wp-content/uploads/2018/10/logo2-1.png" class="w-100">
            </div>
            @yield('content')
        </div>
    </div>
</div>
<!--===================================================-->
<!-- END OF CONTAINER -->


<!--JAVASCRIPT-->
<!--=================================================-->

<!--jQuery [ REQUIRED ]-->
<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/js/jquery.min.js"></script>

<!--BootstrapJS [ RECOMMENDED ]-->
<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/js/bootstrap.min.js"></script>

<!--NiftyJS [ RECOMMENDED ]-->
<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/js/nifty.min.js"></script>

<!--Bootbox Modals [ OPTIONAL ]-->
<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/bootbox/bootbox.min.js"></script>

<!--SweetAlert [ OPTIONAL ]-->
<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/sweet-alert/sweetalert2.min.js"></script>

<!--Toast [ OPTIONAL ]-->
<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/toastr/toastr.min.js"></script>

<!--Select 2 [ OPTIONAL ]-->
<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/select2/js/select2.min.js"></script>

<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/js/custom.js"></script>

@yield('scripts')

<!--Bootstrap toggle [ OPTIONAL ] ALLWAYS BEFORE BS TABLE -->
<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/js/globals.js"></script>

</body>
</html>
