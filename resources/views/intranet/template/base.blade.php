<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{  env('INTRANET_NAME', 'Intranet') }} | @yield('title', 'Dashboard')</title>

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
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/css/demo/nifty-demo-icons.min.css" rel="stylesheet">


    <!--=================================================-->


    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    {{--<link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/pace/pace.min.css" rel="stylesheet">--}}
    {{--<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/pace/pace.min.js"></script>--}}


    <!--Demo [ DEMONSTRATION ]-->
    @include('intranet.template.components.theme')

    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="{{ env('APP_URL_CDN', '') }}/themes/intranet/css/custom.css" rel="stylesheet">

    @yield('styles')

</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>

@include('intranet.template.components.loading')

<div id="container" class="effect aside-bright mainnav-lg footer-fixed navbar-fixed aside-fixed mainnav-fixed">

    <!--NAVBAR-->
    <!--===================================================-->
@include('intranet.template.layouts.navbar')
<!--===================================================-->
    <!--END NAVBAR-->

    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">
            <div id="page-head">
                <div class="row">

                    <div class="col-sm-7">
                        <!--Page Title-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <div id="page-title">
                            <h1 class="page-header text-overflow">@yield('title', 'Titulo')</h1>
                        </div>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End page title-->


                        <!--Breadcrumb-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                    <div class="col-sm-5 text-right" style="padding-right: 30px;padding-top: 45px;">
                        @yield('toolbar-buttons')
                    </div>
                </div>


                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->

            </div>
        {{--<div id="page-head">--}}
        {{--<div class="pad-all text-center">--}}
        {{--<h3>Welcome back to the Dashboard.</h3>--}}
        {{--<p>Scroll down to see quick links and overviews of your Server, To do list, Order status or get some Help using Nifty.</p>--}}
        {{--</div>--}}
        {{--</div>--}}


        <!--Page content-->
            <!--===================================================-->
            <div id="page-content">

                @yield('content')

            </div>
            <!--===================================================-->
            <!--End page content-->

        </div>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->


        <!--ASIDE-->
        <!--===================================================-->

    @include('intranet.template.layouts.aside-container')
    <!--===================================================-->
        <!--END ASIDE-->


        <!--MAIN NAVIGATION-->
        <!--===================================================-->
    @include('intranet.template.layouts.main-nav')
    <!--===================================================-->
        <!--END MAIN NAVIGATION-->

    </div>


    <!-- FOOTER -->
    <!--===================================================-->
@include('intranet.template.layouts.footer')
<!--===================================================-->
    <!-- END FOOTER -->


    <!-- SCROLL PAGE BUTTON -->
    <!--===================================================-->
    <button class="scroll-top btn">
        <i class="pci-chevron chevron-up"></i>
    </button>
    <!--===================================================-->
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


<script src="/themes/intranet/js/globals.js"></script>

<!--Bootstrap table [ OPTIONAL ]-->
<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/bootstrap-table/bootstrap-table.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-es-CL.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/extensions/cookie/bootstrap-table-cookie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/bootstrap-table/extensions/export/bootstrap-table-export.js"></script>
<script src="/themes/intranet/js/custom.js"></script>

@yield('scripts')

<!--Bootstrap toggle [ OPTIONAL ] ALLWAYS BEFORE BS TABLE -->
<script src="{{ env('APP_URL_CDN', '') }}/themes/intranet/plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>



</body>
</html>
