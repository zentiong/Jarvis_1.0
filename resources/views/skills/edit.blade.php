@extends('templates.newsletter-master') 

@section('body')
 
<h1>Edit</h1>

{{ Html::ul($errors->all()) }}


{{ Form::model($skill, array('route' => array('skills.update', $skill->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
    </div>


    {{ Form::submit('Save Changes', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection 