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

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/treasure.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>

            /*Countdown timer*/
            
            #counter {
              background: #2C2C2C;
              -moz-box-shadow:    inset 0 0 5px #000000;
              -webkit-box-shadow: inset 0 0 5px #000000;
              box-shadow:         inset 0 0 5px #000000;
              min-height: 150px;
              text-align: center;
            }
            
            #counter h3 {
              color: #E5E5E5;
              font-size: 14px;
              font-style: normal;
              font-variant: normal;
              font-weight: lighter;
              letter-spacing: 1px;
              padding-top: 20px;
              margin-bottom: 30px;
            }
            
            #countdown {
              color: #FFFFFF;
            }
            
            #countdown span {
              color: #E5E5E5;
              font-size: 26px;
              font-weight: normal;
              margin-left: 20px;
              margin-right: 20px;
              text-align: center;
            }
            #countdown span p{
                display:inline;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height" id="app">
            @if (Route::has('login'))
                <div class="top-right links">
                    
                    @if (Auth::check())
                        <a href="{{ url('/home/') }}">Home</a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name') }}
                </div>
                @if($now->lt($end))
                    <div id="counter">
                        @if($now->lt($start))
                        <h3>Estimated Time Remaining Before Launch:</h3>
                        @else
                        <h3>Estimated Time Remaining Before Finish:</h3>
                        @endif
                        <div id="countdown"></div><!-- /#Countdown Div -->
                    </div> <!-- /.Counter Div -->
                @else
                    <div id="counter">
                        <h1>Game Over</h1>
                    </div> <!-- /.Counter Div -->
                @endif
            </div>

        </div>
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
    </body>
    
</html>
