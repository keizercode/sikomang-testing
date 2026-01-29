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
        <link href="{{asset('assets/css/select2.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-table.min.css')}}">
        <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- alertifyjs Css -->
        <link href="{{ asset('assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- alertifyjs default themes  Css -->
        <link href="{{ asset('assets/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" />
        {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/DataTables/datatables.custom.css') }}"> --}}
        <style>
            .select2-hidden-accessible{position: relative!important;}
        </style>
        @yield('css')
    </head>
    <body>
        <div id="layout-wrapper">
            @include('include.topbar')
            @include('include.sidebar')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © SIGD.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    <a href="https://Themesdesign.com/" target="_blank" class="text-reset">Dinas Lingkungan Hidup Provinsi DKI Jakarta</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php //include 'partials/right-sidebar.php'; ?>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenujs/metismenujs.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/eva-icons/eva.min.js')}}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        {{-- <script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script> --}}
        <script src="{{asset('assets/js/bootstrap-table.min.js')}}"></script>
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('assets/libs/alertifyjs/build/alertify.min.js') }}"></script>
        <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2.js') }}"></script>

        
        @yield('js')
        <script>
            $('.select2').select2();
            @if (Session::get('error'))
                alertify.error("{{ Session::get('error') }}");
            @endif
            @if (Session::get('success'))
                alertify.success("{{ Session::get('success') }}");
            @endif
            @if (Session::get('warning'))
                alertify.warning("{{ Session::get('warning') }}");
            @endif
        </script>
    </body>

</html>