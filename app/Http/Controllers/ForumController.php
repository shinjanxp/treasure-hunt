<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Question;
use \App\Post;
class ForumController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // public function show(){
    //     $level = \Auth::user()->level;
    //     $question = \App\Question::find($level);
    //     $posts = $question->posts;
    //     $questions = \App\Question::with('posts')->get();
    //     return view('forum')->with(compact('question','posts','questions'));
    // }
    // public function post(Request $request){
    //     $level = \Auth::user()->level;
    //     $question = \App\Question::find($level);
    //     $post= \App\Post::create([
    //         'question_id' => $question->id,
    //         'user_id' => \Auth::user()->id,
    //         'body' => $request->post,
    //         'user_ip' => $request->ip()
    //     ]);
    //     return redirect('/forum');
    // }
    
    
    public function showById(Question $question){
        
        if(!$question->id)
            $question = \App\Question::find(\Auth::user()->level);
        if(!$question)
            return redirect('/play');
        $this->authorize('showById',[Post::class,$question]);
        $posts = $question->posts;
        $questions = \App\Question::with('posts')->get();
        return view('forum')->with(compact('question','posts','questions'));
    }
    
    public function postById(Request $request, Question $question){
        $this->authorize('postById',[Post::class,$question]);
        $post= \App\Post::create([
            'question_id' => $question->id,
            'user_id' => \Auth::user()->id,
            'body' => $request->post,
            'user_ip' => $request->ip()
        ]);
        return redirect('/forum/'.$question->id);
    }
}
