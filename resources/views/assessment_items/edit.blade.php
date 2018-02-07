@extends('templates.newsletter-master')

@section('body')

<h1>Edit {{ $assessment->criteria }} </h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

<!--


-->


{{ Form::model($assessment, array('route' => array('assessments.assessment_items.update', $assessment->id, $assessment_item->id ), 'method' => 'PUT')) }}


    <div class="form-group">
        {{ Form::label('criteria', 'Criteria') }}
        {{ Form::text('criteria', Request::old('criteria'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit this Assessment Item!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}


@endsection