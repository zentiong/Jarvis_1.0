@extends('templates.newsletter-master')

@section('body')

<h1>Add Assessment Items</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'assessments/'.$id.'/assessment_items')) }}
    <div id="div1">
        <div class="form-group">
            {{ Form::label('criteria', 'Criteria') }}
            {{ Form::text('criteria', Request::old('criteria'), array('class' => 'form-control')) }}
        </div>
    </div>

    <br>
    {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    
{{ Form::close() }}


@endsection