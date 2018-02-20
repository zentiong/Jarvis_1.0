@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


@section('body')

<h1>Edit Training Session</h1>

{{ Html::ul($errors->all()) }}


{{ Form::model($training_session, 
array('route' => array('training_sessions.update', $training_session->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('date', 'Date') }}
        {{ Form::date('date', Request::old('date'), 
        array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('starting_time', 'Starting Time') }}
        {{ Form::time('starting_time', Request::old('starting_time'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('ending_time', 'Ending Time') }}
        {{ Form::time('ending_time', Request::old('ending_time'), array('class' => 'form-control')) }}

     <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', Request::old('title'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('speaker', 'Speaker') }}
        {{ Form::text('speaker', Request::old('speaker'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('venue', 'Venue') }}
        {{ Form::text('venue', Request::old('venue'), array('class' => 'form-control')) }}
    </div>

  

    {{ Form::submit('Edit Training Session', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@endsection