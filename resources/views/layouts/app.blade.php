<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('styles')
</head>
<body>
    <div id="app">
        <div id="barba-wrapper">
            @include('includes.header')

            <main class="py-4 barba-container">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
