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
        <div id="swup-header">
            @include('includes.header')
        </div>
        <div id="swup-main" class="page-content">
            @yield('content')
        </div>
        @include('includes.footer')
    </div>


    
    <script type="text/javascript">
        var addthis_config = addthis_config||{};
        addthis_config.lang = 'ar'; //show in Spanish regardless of browser settings;
    </script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b909d4eed106f4a"></script>

    {{-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xkrstfxd975kjdemdcwwy4fh7du1qpoz51lk20i6p3h0lcmo"></script> --}}

    @yield('scripts')
</body>
</html>
