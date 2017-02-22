@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <h2>Level: {{Auth::user()->level}}</h2>
                    <h2>Attempts: {{Auth::user()->submissions->count()}}</h2>
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
