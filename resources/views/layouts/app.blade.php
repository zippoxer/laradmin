@php
    $bodyClass = isset($bodyClass) ? ' '.$bodyClass : '';
    $pageTitle = isset($pageTitle) ? ' - '.$pageTitle : '';
@endphp

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}{{ $pageTitle }} - @lang('laradmin::template.name')</title>

    <script>
        window.laradmin = {!! app('laradmin')->jsObject() !!}
    </script>

    <script src="https://use.fontawesome.com/a89966cad4.js"></script>
    <link rel="stylesheet" href="{{ laradmin_asset('/css/app.css') }}">
    @yield('styles')

</head>

<body class="laradmin{{ $bodyClass }}">

    <div id="app">

        @yield('main-content')

    </div>

    @yield('scripts')

    @if(view()->exists('laradmin::before-scripts'))
        @include('laradmin::before-scripts')
    @endif

    <script src="{{ laradmin_asset('/js/app.js') }}"></script>
</body>

</html>