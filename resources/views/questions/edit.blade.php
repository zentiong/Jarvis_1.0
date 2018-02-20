@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')

<h1>Edit {{ $question->question_item }} </h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

<!--


-->


{{ Form::model($question, array('route' => array('quizzes.questions.update', $quiz->quiz_id, $question->id ), 'method' => 'PUT')) }}


    <div class="form-group">
        {{ Form::label('question_item', 'Question') }}
        {{ Form::text('question_item', Request::old('question_item'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('answer_item', 'Answer') }}
        {{ Form::text('answer_item', Request::old('answer_item'), array('class' => 'form-control')) }}
    </div>


    {{ Form::submit('Edit this Question!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}


@endsection