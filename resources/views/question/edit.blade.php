@extends('layouts.app')

@section('head-section')
<style>
textarea, iframe{
        display: block;
		margin: 10px 0;
    }
    iframe{
        width: 100%;
        height:440px;
        border: 1px solid #a9a9a9;
    }
    </style>
@endsection

@section('content')
<div class="container">
    <a href="/question"> &lt; Back to questions</a>
    @if( isset($question) )
        <div class="row"> 
            <h2 class="col-md-6">Edit Question {{$question->id}}</h2>
        
            <form action="/question/{{$question->id}}" class="col-md-6" method="POST">
                <input name="_method" type="hidden" value="DELETE">
                    {{ csrf_field() }}
                    <input type="text" class="col-md-6 form-control" placeholder="Type DELETE and press the button to delete" name="keyword">
                <button type="submit" class="pull-right btn btn-danger btn-small">Delete</button>
            </form>
        </div>
        <form action="/question/{{$question->id}}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            
    @else
        <form action="/question" method="POST">
            <h2>Create question</h2>
    @endif
    {{ csrf_field() }}
    @if($errors->any())
       @foreach ($errors->all() as $error)
          <div class="alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ $error }}</div>
      @endforeach
    @endif
        <div class="row">
            <div class="col-md-6">
                <h4>Edit HTML</h4>
                <textarea name="question_html" id="editbox" cols="90" rows="20">{{ old('question_html',  isset($question->question_html) ? $question->question_html : null) }}</textarea>
            </div>
            <div class="col-md-6">
                <h4>Output</h4>
                <iframe id="dynamicframe" cols="90"></iframe>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Explanation</h4>
                <textarea name="explanation" id="" cols="50" rows="10" required>{{ old('explanation',  isset($question->explanation) ? $question->explanation : null) }}</textarea>
            </div>
            
            <div class="col-md-4">
                <h4>Solution</h4>
                <input type="text"  name="solution" value="{{ old('solution',  isset($question->solution) ? $question->solution : null) }}" required/>
            </div>
            <div class="col-md-4">
                <h4>Serial number</h4>
                <input type="number" clsss="form-control" name="id" value="{{ old('id',  isset($question->id) ? $question->id : null) }}" required/>
                <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
        </div>
    </form>
</div>

@endsection


@section('bottom-section')
<script>


var defaultStuff = '<h3>Welcome to the real-time HTML editor!<\/h3>\n' +
'<p>Type HTML in the Edit HTML section, and it will magically appear in the Output section.<\/p>';

var old = '';
if($('#editbox').val()=="")
    $('#editbox').val(defaultStuff)

function updateIframe(){
	var dynamicframe = $("#dynamicframe").contents().find('body');
    var textareaValue = $("#editbox").val();

    dynamicframe.html(textareaValue);
}
window.setInterval(updateIframe,150)
</script>
@endsection
