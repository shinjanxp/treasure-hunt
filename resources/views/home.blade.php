@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                        <h2> 
                        @if(Auth::user()->level<=$last_level)
                        <td>Level:{{Auth::user()->level}}</td>
                        @else
                        <td>Game Over</td>
                        @endif
                        @if(Auth::user()->is_admin())
                        <form action="/reset" method="POST" class="pull-right">
                            {{csrf_field()}}
                            <button class="btn btn-primary btn-sm" type="submit">RESET LEVEL</button>
                        </form>
                        @endif
                    </h2>
                    <!--<h2>Attempts: {{Auth::user()->submissions->count()}}</h2>-->
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Instructions</div>

                <div class="panel-body">
                   <!--Instructions-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
