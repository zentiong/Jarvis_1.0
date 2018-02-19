@extends('templates.dashboard-master')

@section('body')
<div class="container">



<h1>Add Position</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'positions')) }}

    <div class="form-group">
        {{ Form::label('name', 'Position Name') }}
        {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
    </div>

  

    {{ Form::submit('Add Position', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection