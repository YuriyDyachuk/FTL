<!DOCTYPE html>
<html>
<head>
    @routes
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 3'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    @if(! config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @include('adminlte::plugins', ['type' => 'css'])

    @yield('adminlte_css_pre')


    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jtoggler.styles.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/datepicker.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    @yield('adminlte_css')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>
    @if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
    @endif

    @if(config('adminlte.plugins.datatables'))
    <!-- DataTables with bootstrap 3 style -->
        <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.19/datatables.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap4.min.css">
    @endif
</head>
<body class="@yield('classes_body')" @yield('body_data')>

@yield('body')
@if(! config('adminlte.enabled_laravel_mix'))
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jsrender/0.9.90/jsrender.min.js"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    @include('adminlte::plugins', ['type' => 'js'])

    @yield('adminlte_js')
@else
    <script src="{{ asset('js/app.js') }}"></script>
@endif

<script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
@endif

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables with bootstrap 3 renderer -->
    <script src="//cdn.datatables.net/v/bs/dt-1.10.19/datatables.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endif

@if(config('adminlte.plugins.chartjs'))
    <!-- ChartJS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
@endif
<script src="{{asset('/js/notify.min.js')}}"></script>
<script src="{{asset('/js/jtoggler.js')}}"></script>
<script src="{{ asset('/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('/js/main.js') }}"></script>
<script src="{{ asset('/js/ordernoteswidget.js') }}"></script>
<script src="{{ asset('/js/datepicker.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
@stack('head')
</body>
</html>
