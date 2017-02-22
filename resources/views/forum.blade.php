@extends('layouts.app')

@section('content')
<div class="container main_body">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				 <div class="well"  style="padding:0;">
					<div class="row">
						<div class="col-md-4">
<div class = "clock">
	<a href="#" id="timer"></a></div>
</div>

						<div class="col-md-4">
							<h4 id="levelno" align="center"><strong>FORUM LEVEL {{$question->id}}</strong></h4>
						</div>    
					</div>
				</div>

					@foreach($posts as $post)
					<div class="well" style="margin-bottom:0.6em;" id="post">
    					<div class="row">
    						<div class="col-md-2" align="center" >
    						    @if($post->user->is_admin())
    							    <img class="img img-responsive img-circle forum-img" src="{{ asset('images/admin.png') }}">
    							@else
    							    <img class="img img-responsive img-circle forum-img" src="{{ asset('images/player.jpg') }}">
                                @endif
    							<p><strong>{{$post->user->name}}</strong></p>
    						</div>
    						<div class="col-md-8">
    							<p>{{$post->body}}</p>
    						</div>
    						<div class="col-md-2">
    							<strong>{{$post->created_at}}</strong>
    							@if(Auth::user()->is_admin())
    								<br><button type="button" class="btn btn-danger btn-sm " >Delete</button>
    						    @endif
    						</div>
    						
    					</div>
    				</div>      
				    @endforeach	
							
				<hr>
					<div class="well" style="margin-bottom:0.6em;" id="post">
					<div class="row">
						<div class="col-md-2" align="center">
							@if(Auth::user()->is_admin())
							    <img class="img img-responsive img-circle" src="{{ asset('images/admin.png') }}">
							@else
							    <img class="img img-responsive img-circle" src="{{ asset('images/player.jpg') }}">
                            @endif
							<br><p><strong>{{Auth::user()->name}}</strong></p>
						</div>
						<div class="col-md-10">
								<form action="/forum/{{$question->id}}" method="POST" class="col-md-12">
						
								{{csrf_field()}}
								<textarea class="form-control" rows="5" id="post" name="post" placeholder="Post your reply here!"></textarea>
								&nbsp;
								<button type="submit" class="btn btn-primary pull-right" id="submitPost" name="submitPost">Submit</button>
							</form>
						</div>
						
					</div>
				</div>
				@if(Auth::user()->is_admin())
				<div class="well" style="padding:0;">
					<h4 id="levelno" align="center">Select Level</h4>
				</div>
				<br>
				<div class="row" id="buttonrow">
					
    					@foreach($questions as $q)
    					<div class="col-xs-2">
    					    <a type="button" class="btn btn-block btn-lg btn-default" href="/forum/{{$q->id}}">Level {{$q->id}}
    						<span class="badge pull-right"> {{$q->posts->count()}} </span>;
    						</a>
    					</div>
    					@endforeach
					
				</div>
				@endif
			</div>
		</div>
		
	</div>
@endsection
