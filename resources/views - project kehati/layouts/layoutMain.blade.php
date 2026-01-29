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

<body class="poppins-regular">
    <div class="flex mt-2">
        <div class="flex md:w-[25%] items-center p-5">
            <a class="navbar-brand" asp-area="" asp-controller="Home" asp-action="Index">
                <div class="flex gap-3 items-center">
                    <div>
                        <img src="{{ asset('assets/images/logo-dinas.ico') }}" alt="" width="35">
                    </div>
                    <div class="flex flex-col">
                        <h4 class="font-bold text-[#197B30]">KEHATI</h4>
                        <h4 class="text-[12px] text-[#E9811A]">Dinas Lingkungan Hidup Provinsi DKI Jakarta</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="md:w-[75%] flex items-center justify-between py-5 px-5">
            <div>
                <input type="text" placeholder="Cari..." class="bg-white border border-gray-300 text-gray-900 text-sm rounded-full block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="flex gap-2 bg-[#197B30] items-center p-1 text-white rounded-full">
                <a href="{{ url('persebaran/lokasi') }}" class="bg-[#064014] rounded-full p-3 text-[12px]  flex gap-1">
                    <span>Grid</span>
                    <img src="{{ asset('assets/images/grid.svg') }}" alt="" width="15">
                </a>
                <a href="{{ url('map') }}" class="pr-3 text-[12px] flex gap-1">
                    <span>Peta</span>
                    <img src="{{ asset('assets/images/globe.svg') }}" alt="" width="15">
                </a>
            </div>
        </div>
    </div>
    <div class="flex">
        @include('include.sidebarfront')
        
        @yield('content')
    </div>

    <footer class="flex relative items-center hidden justify-center mx-auto">
        <span class="text-sm">&copy; 2025 - Dinas Lingkungan Hidup Provinsi DKI Jakarta</span>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @yield('js')
</body>

</html>