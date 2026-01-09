<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIKOMANG - Sistem Informasi dan Komunikasi Mangrove DKI Jakarta">
    <title>@yield('title', 'SIKOMANG - Sistem Informasi dan Komunikasi Mangrove DKI Jakarta')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://pencil-matter-70015947.figma.site/_assets/v11/5a52c0026642845f54f76f85096c3a34c237af42.png">


    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#009966',
                        'primary-dark': '#2d5c54',
                        'primary-light': '#5a9e91',
                        secondary: '#242621',
                        navbar: '#003D28',
                        accent: '#8f9d5d',
                        muted: '#4c5250',
                        background: '#fbfbfb',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #009966 100%);
        }

        .quote-icon {
            color: #f59e0b;
        }

        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .article-card {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #418276;
        }

        .btn-primary {
            background-color: #418276;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2d5c54;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-background text-secondary antialiased">
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    @stack('scripts')
</body>
</html>
