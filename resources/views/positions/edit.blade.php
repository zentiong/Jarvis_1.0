@extends('templates.dashboard-master')

@section('body')

<h1>Edit Position</h1>

{{ Html::ul($errors->all()) }}


{{ Form::model($position, 
array('route' => array('positions.update', $position->id), 'method' => 'PUT')) }}


    <div class="form-group">
        {{ Form::label('name', 'Position Name') }}
        {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
    </div>

  

    {{ Form::submit('Edit Position', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@endsection