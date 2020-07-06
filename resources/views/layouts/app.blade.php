<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets') }}/images/manggala.png">
    <title>SIM Admin !</title>
    <!-- Bootstrap Core CSS -->
    {{-- <link href="{{ asset('assets') }}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{ asset('assets') }}/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Datatable CSS -->
    <link href="{{ asset('assets') }}/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="{{ asset('assets') }}/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/custom.css" id="theme" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/select2.min.css" id="theme" rel="stylesheet">

    <!-- Color picker plugins css -->
    <link href="{{ asset('assets') }}/plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="{{ asset('assets') }}/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="{{ asset('assets') }}/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- CSS Countdown -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/jquery-countdown/css/jquery.countdown.css" />
    <!-- Bootstrap Toogle -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    @if(Session::has('dataUser'))
        @if (Session::get('dataUser')->nama_divisi == 'Direktur')
            <link href="{{ asset('assets') }}/css/colors/light-green.css" id="theme" rel="stylesheet">
        @elseif (Session::get('dataUser')->nama_divisi == 'CS')
            <link href="{{ asset('assets') }}/css/colors/cs.css" id="theme" rel="stylesheet">
        @else
            <link href="{{ asset('assets') }}/css/colors/light-green.css" id="theme" rel="stylesheet">
        @endif
    @else
        <link href="{{ asset('assets') }}/css/colors/green.css" id="theme" rel="stylesheet">
    @endif
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- daterangepicker CSS -->
    <link href="{{ asset('assets') }}/css/daterangepicker.css" rel="stylesheet">
    <!-- <link href="{{ asset('assets') }}/css/select2.min.css" id="theme" rel="stylesheet"> -->
    @stack('styles')
</head>
<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    @guest
    @yield('content')
    @endguest
    @auth
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('layouts.header.header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('layouts.sidebar.left')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                {{-- @include('layouts.header.titles') --}}
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                @yield('content')
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                @include('layouts.sidebar.right')
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © {{date('Y')}} SMA Manggala Sakti </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    @endauth

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootbox JavaScript -->
    <script src="{{ asset('assets') }}/js/bootbox.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('assets') }}/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="{{ asset('assets') }}/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('assets') }}/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="{{ asset('assets') }}/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('assets') }}/js/custom.js"></script>
    <script src="{{ asset('assets') }}/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <script src="{{ asset('assets') }}/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="{{ asset('assets') }}/plugins/d3/d3.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <!-- <script src="{{ asset('assets') }}/js/dashboard1.js"></script> -->
    <!-- Datatable -->
    <script src="{{ asset('assets') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/dataTables.bootstrap4.min.js"></script>
    <!-- Sweet Alert 2-->
    <script src="{{ asset('assets') }}/js/sweetalert2@9.js"></script>
    <!-- Moment.js -->
    <script src="{{ asset('assets') }}/js/moment.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets') }}/js/daterangepicker.min.js"></script>
    <!-- Bootstrap Toggle -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets') }}/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="{{ asset('assets') }}/magnific-popup/jquery.magnific-popup.js"></script>


    <script src="{{ asset('assets') }}/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/js/buttons.flash.min.js"></script>
    <script src="{{ asset('assets') }}/js/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/js/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/js/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/js/select2.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
