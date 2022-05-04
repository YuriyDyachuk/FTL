<!DOCTYPE html>
<html>
<head>
    @routes
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))</title>

    <link rel="stylesheet" href="{{ asset('css/jtoggler.styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/talk.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.min.css') }}">
{{--    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}


    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-subheader--enabled  kt-subheader--solid kt-aside--enabled kt-page--loading @yield('classes_body')" @yield('body_data')>

@yield('body')

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/jtoggler.js')}}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/ordernoteswidget.js') }}"></script>
<script src="{{ asset('js/jsrender.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('js/i18n/datepicker.ru.js') }}"></script>
<script src="{{ asset('js/numeral.js') }}"></script>
<script src="{{ asset('js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('js/jquery.autocomplete.js') }}"></script>
{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
@yield('js')
@stack('head')
</body>
</html>
