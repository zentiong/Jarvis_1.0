@extends('templates.dashboard-master')

@section('body')

<h1>Add Questions</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'quizzes/'.$quiz_id.'/questions')) }}
    <div id="div1">
        <div class="form-group">
            {{ Form::label('question_item', 'Question') }}
            {{ Form::text('question_item', Request::old('question_item'), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('answer_item', 'Answer') }}
            {{ Form::text('answer_item', Request::old('answer_item'), array('class' => 'form-control')) }}
        </div>
    </div>

    <br>
    {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    
{{ Form::close() }}


@endsection