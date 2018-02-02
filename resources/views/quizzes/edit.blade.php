@extends('templates.newsletter-master')

@section('body')

<h1>Edit {{ $quiz->topic }} </h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}


{{ Form::model($quiz, array('route' => array('quizzes.update', $quiz->quiz_id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('topic', 'Topic') }}
        {{ Form::text('topic', Request::old('topic'), array('class' => 'form-control')) }}
    </div>


    {{ Form::submit('Edit the Quiz!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection