<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Question;
use \App\Submission;
class PlayController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function show(){
        if (\Gate::denies('play')) {
            abort(401,"Cant play yet");
        }
        $level = \Auth::user()->level;
        $question = Question::find($level);
        if($question){
            $submissions = Submission::where('user_id','=',\Auth::user()->id)->where('question_id','=',$question->id)->get();
            return view('play')->with(compact('question','submissions'));
        }
        else
            return view('play')->with(compact('question'));
    

    }
    
    public function submit(Request $request){
        if (\Gate::denies('play')) {
            abort(401,"Cant play yet");
        }
        $user = \Auth::user();
        $level = $user->level;
        $question = Question::find($level);
        $submission=Submission::create([
            'user_id'=>$user->id,
            'question_id' => $question->id,
            'submission_text' => $request->submission_text,
            'user_ip' => $request->ip()
        ]);
        if($question->evaluate($submission)){
            // submission is correct
            $user->level++;
            $user->last_level_cleared_at = \Carbon\Carbon::now();
            $user->save();
            
            flash($question->explanation,'success')->important();

        }
        else 
            flash('Oops! Wrong answer. Try again', 'danger');
        return redirect('/play');
        
    }
    public function reset(){
        if(!\Auth::user()->is_admin())
            abort(401,"Not authorized");
        
        $user=\Auth::user();
        $user->level=1;
        $user->last_level_cleared_at = \Carbon\Carbon::now();
        $user->submissions()->delete();
        $user->save();
        return redirect('/home');
    }
}
