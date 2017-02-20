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
        $level = \Auth::user()->level;
        $question = Question::find($level);
        $submissions = Submission::where('user_id','=',\Auth::user()->id)->where('question_id','=',$question->id)->get();
        return view('play')->with(compact('question','submissions'));
    }
    
    public function submit(Request $request){
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
            $user->save();
            flash($question->explanation,'success')->important();

        }
        else 
            flash('Oops! Wrong answer. Try again', 'danger');
        return redirect('/play');
    }
}
