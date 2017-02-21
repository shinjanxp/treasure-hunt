@extends('layouts.app')

@section('content')

<div class="container">
    @include('flash::message')
    @if($question)
    <div class="row">
        <div class="pull-left"><h2>Level {{$question->id}}</h2></div>
    </div>
    
    
    <div class="row">
        <center>{!! $question->question_html !!}</center>
        
        <center class>
            <div class="col-md-6 col-md-offset-3">
                <form action="/play" method="POST">
                    {{csrf_field()}}
                    <input id="submission_text" type="text" class="form-control" name="submission_text" placeholder="Submit answer here" required autofocus>
                    <br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="col-md-3">
                <h4>Your previous submissions</h4>
                <div class="list-group">
                    @foreach ($submissions as $submission)
                    <p class="list-group-item">
                        {{$submission->submission_text}}
                    </p>
                    @endforeach
                       
                </div>
            </div>
        </center>
    </div>
    @else
    <div class="row">
        <center>
            <h1>YOU'RE THERE!</h1>
            <img src="{{ asset('/images/youreawesome.jpg') }}"></img>
        </center>
        
    </div>
    @endif
</div>
@endsection

@section('bottom-section')
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection