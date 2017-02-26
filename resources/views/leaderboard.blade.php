@extends('layouts.app')

@section('content')

<div class="container">
	 <div class="well" >
		<div class="row">

			<div class="col-md-4 col-md-offset-4">
				<h4 align="center"><strong>LEADERBOARD</strong></h4>
			</div>    
		</div>
	</div>
	
	<div class="well">
	    <div class="table-responsive">
	        
	     <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Institute</th>
                <th>Level</th>
                <th>Cleared at</th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->institute}}</td>
                @if($user->level<=$last_level)
                <td>{{$user->level}}</td>
                @else
                <td>Game Over</td>
                @endif
                
                @if($user->level==1)
                <td>Just started</td>
                @else
                <td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->last_level_cleared_at)->setTimezone('Asia/Calcutta')}}</td>
                @endif
              </tr>
            @endforeach
            </tbody>
          </table>
	    </div>
	</div>
    
</div>

@endsection