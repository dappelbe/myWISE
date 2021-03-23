<!--
=========================================================
* Volt - Bootstrap 5 Admin Dashboard
=========================================================
* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2020 Themesberg (https://www.themesberg.com)
* Designed and coded by https://themesberg.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal.
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WISE Study - {{ $pageTitle }}</title>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jAlert.min.js')}}"></script>
    <script src="{{asset('js/jAlert-functions.min.js')}}"></script>
    <script src="{{asset('js/jTimeout.min.js')}}"></script>

    <script>
        $(function(){
            $.jTimeout({
                timeoutAfter: 600,
                secondsPrior: 120,
                extendUrl: '/',
                extendOnMouseMove: true,
                mouseDebounce: 300
            });
        });
    </script>
    <!--===============================================================================================-->
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('/assets/img/favicon/apple-touch-icon.png')}}"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('/assets/img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('/assets/img/favicon/favicon-16x16.png"')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Fontawesome -->
    <link type="text/css" href="{{url('/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!-- Notyf -->
    <link type="text/css" href="{{url('/vendor/notyf/notyf.min.css')}}" rel="stylesheet">
    <!-- Volt CSS -->
    <link type="text/css" href="{{url('/css/volt.css')}}" rel="stylesheet">
    <!-- jAlert -->
    <link href="{{asset('css/jAlert.css')}}" rel="stylesheet">
    <!--===============================================================================================-->
</head>
<body>
    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-md-none">
        <a class="navbar-brand mr-lg-5" href="../../index.html">
            <img class="navbar-brand-dark" src="../../assets/img/brand/light.svg" alt="Volt logo" /> <img class="navbar-brand-light" src="../../assets/img/brand/dark.svg" alt="Volt logo" />
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid bg-soft">
        <div class="row">
            <div class="col-12">
                @include('layouts.partials.sidebar')
                <main class="content">
                    @include('layouts.partials.topbar')
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

@include('layouts.partials.footer')
<!--===============================================================================================-->
<script src="{{url('/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{url('/vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Vendor JS -->
<script src="{{url('/vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>
<!-- Slider -->
<script src="{{url('/vendor/nouislider/distribute/nouislider.min.js')}}"></script>
<!-- Jarallax -->
<script src="{{url('/vendor/jarallax/dist/jarallax.min.js')}}"></script>
<!-- Smooth scroll -->
<script src="{{url('/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>
<!-- Count up -->
<script src="{{url('/vendor/countup.js/dist/countUp.umd.js')}}"></script>
<!-- Notyf -->
<script src="{{url('/vendor/notyf/notyf.min.js')}}"></script>
<!-- Charts -->
<script src="{{url('/vendor/chartist/dist/chartist.min.js')}}"></script>
<script src="{{url('/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<!-- Datepicker -->
<script src="{{url('/vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>
<!-- Simplebar -->
<script src="{{url('/vendor/simplebar/dist/simplebar.min.js')}}"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Volt JS -->
<script src="{{url('/assets/js/volt.js')}}"></script>
<!--===============================================================================================-->

@yield('pagejs')
</body>
</html>
