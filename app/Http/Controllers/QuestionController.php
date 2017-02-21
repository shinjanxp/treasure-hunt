<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Question;
class QuestionController extends Controller
{
    public function __construct() {
       $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Question::class);
        $questions = Question::all();
        return view('question.index')->with(compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Question::class);
        return view('question.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Question::class);
        $this->validate($request, [
            'question_html' => 'required',
            'solution' =>'required|regex:[a-z]',
            'explanation' => 'required',
            'id' => 'required|integer|unique:questions',
        ]);
        $q=Question::create($request->all());
        return redirect('/question/'.$q->id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $this->authorize('update', $question);
        return view('question.edit')->with(compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->authorize('update', $question);
        $this->validate($request, [
            'question_html' => 'required',
            'solution' =>'required|regex:/^[(a-z)]+$/u',
            'explanation' => 'required',
            'id' => 'required|integer|unique:questions,id,'.$question->id,
        ]);
        $question->update($request->all());
        return redirect('/question/'.$question->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Question $question)
    {
        $this->authorize('delete', $question);
        $this->validate($request,[
            'keyword' =>"regex:'DELETE'"
        ]);
        $question->delete();
        return redirect('/question');
    }
}
