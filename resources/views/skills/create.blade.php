@extends('templates.newsletter-master')

@section('body')

<h1>Add New Skill</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'skills')) }}

    <div class="form-group"> 
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection


