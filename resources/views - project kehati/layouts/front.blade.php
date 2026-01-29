<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title',@$title) | KEHATI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="KEHATI" name="description" />
    <meta content="ilhamwara" name="author" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/logo-dinas.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/logo-dinas.ico') }}">
    <link rel="mask-icon" href="{{ asset('assets/logo-dinas.ico') }}" color="#5bbad5">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- Bootstrap Css -->
    {{-- <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" /> --}}
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-table.min.css')}}">
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- alertifyjs Css -->
    <link href="{{ asset('assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- alertifyjs default themes  Css -->
    <link href="{{ asset('assets/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>

    <body class="poppins-regular">
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3 py-5 px-5">
            <div class="container mx-auto max-w-7xl">
                <div class="flex justify-between">
                    <div>
                        <a class="navbar-brand" asp-area="" asp-controller="Home" asp-action="Index">
                            <div class="flex gap-3 items-center">
                                <div>
                                    <img src="{{ asset('assets/images/logo-dinas.ico') }}" alt="" width="35">
                                </div>
                                <div class="flex flex-col">
                                    <h4 class="font-bold text-[#197B30]">KEHATI</h4>
                                    <h4 class="text-sm text-[#E9811A]">Dinas Lingkungan Hidup Provinsi DKI Jakarta</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="flex gap-6 items-center">
                        <div><a class="text-sm" href="{{ url('persebaran/lokasi') }}">Persebaran Flora dan Fauna</a></div>
                        <div><a class="text-sm" href="{{ url('cagar-budaya') }}">Cagar Budaya</a></div>
                        <div><a class="text-sm" href="{{ url('berita') }}">Berita</a></div>
                        <div><a class="text-sm" href="{{ url('tentang-kami') }}">Tentang Kami</a></div>
                        <div><a class="text-sm px-4 py-2 bg-[#197B30] text-white rounded-full" href="{{ url('login') }}">Login</a></div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="">
        <main role="main" class="pb-3 min-h-screen">
            @yield('content')
        </main>
    </div>

    <footer class="flex relative items-center justify-center mx-auto">
        <span class="text-sm">&copy; 2025 - Dinas Lingkungan Hidup Provinsi DKI Jakarta</span>
    </footer>
    <script src="~/lib/jquery/dist/jquery.min.js"></script>
    <script src="~/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="~/js/site.js" asp-append-version="true"></script>
    
    @yield('js')

</body>

</html>