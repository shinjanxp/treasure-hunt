<?php 
$start = \Carbon\Carbon::parse(env('GAME_START_TIME'));
$end = \Carbon\Carbon::parse(env('GAME_END_TIME'));
$now = \Carbon\Carbon::now();
?>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/treasure.css') }}" rel="stylesheet">

    <style>
        #counter{
            padding:14px;
        }
        #countdown>span>p{
            font-size:8px;
            display:inline;
        }
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="http://code.jquery.com/jquery.min.js"></script>
    
    @yield('head-section')
</head>
<body>
    <div id="app" class="full-height">
        @include('layouts.nav')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script>
    // set the date we're counting down to

    @if($now->lt($start))
        var target_date = new Date('{{env('GAME_START_TIME')}}').getTime();
    @elseif($now->gt($start) && $now->lt($end))
        var target_date = new Date('{{env('GAME_END_TIME')}}').getTime();
    @endif
    </script>
    @if($now->lt($end))
        <script src="{{ asset('js/counter.js') }}"></script>
    @endif

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @yield('bottom-section')
</body>
</html>
