@extends('templates.newsletter-master')

@section('body')
<div class="container">



<h1>Create Training Session</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'training_sessions')) }}

    <div class="form-group">
        {{ Form::label('date', 'Date') }}
        {{ Form::date('date', Request::old('date'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('starting_time', 'Starting Time') }}
        {{ Form::time('starting_time', Request::old('starting_time'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('ending_time', 'Ending Time') }}
        {{ Form::time('ending_time', Request::old('ending_time'), array('class' => 'form-control')) }}
    </div>

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

  

    {{ Form::submit('Create Training Session', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection