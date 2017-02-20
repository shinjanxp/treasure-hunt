@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="pull-left"><h2>Questions list</h2></div>
        <div class="pull-right"><a href="/question/create" class="btn btn-primary">Create</a></div>
    </div>
    <div class="row">
        <div class="list-group">
            @foreach ($questions as $question)
            <a class="list-group-item" href="/question/{{$question->id}}/edit">
                
                Question {{$question->id}}. {{$question->solution}} 
                
            </a>
            @endforeach
               
        </div>
    </div>
</div>
@endsection