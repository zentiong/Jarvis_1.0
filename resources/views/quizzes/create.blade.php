@extends('templates.newsletter-master')

@section('body')

<h1>Create a Quiz</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'quizzes')) }}

    <div class="form-group">
        {{ Form::label('topic', 'Topic') }}
        {{ Form::text('topic', Request::old('topic'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Quiz!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection


