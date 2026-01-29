<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title',@$title) | KEHATI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SIDG" name="description" />
        <meta content="ilhamwara" name="author" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/logo-dinas.ico') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/logo-dinas.ico') }}">
        <link rel="mask-icon" href="{{ asset('assets/logo-dinas.ico') }}" color="#5bbad5">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        @yield('css')
    </head>
    <body>
        @yield('content')
        <!-- END layout-wrapper -->

        <?php //include 'partials/right-sidebar.php'; ?>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenujs/metismenujs.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/eva-icons/eva.min.js')}}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        @yield('js')

    </body>

</html>