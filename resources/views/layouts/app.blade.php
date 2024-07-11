<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Photopie') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">

    {{-- CSS --}}
    <link id="themeColors" rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" />

    {{-- CSS LAYOUTS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-layouts.css') }}">

    {{-- Sweet Alert CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}">

    {{-- STACK STYLE --}}
    @stack('style')

    {{-- Livewire Style --}}
    @livewireStyles()
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" />
    </div>

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <livewire:components.sidebar />
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <livewire:components.header />
            <!--  Header End -->
            {{-- Content --}}
            <div class="container-fluid">
                @yield('content')
            </div>
            {{-- Content --}}
        </div>
    </div>

    <!--  Import Js Files -->
    <script data-navigate-once src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--  core files -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.init.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!--  current page js files -->
    <script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    {{-- STACK SCRIPT --}}
    @stack('script')

    {{-- Livewire Script --}}
    @livewireScripts()
</body>

</html>
