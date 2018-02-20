@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')

<h1>Edit {{ $assessment->topic }} </h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}


{{ Form::model($assessment, array('route' => array('assessments.update', $assessment->assessment_id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('topic', 'Topic') }}
        {{ Form::text('topic', Request::old('topic'), array('class' => 'form-control')) }}
    </div>


    {{ Form::submit('Edit the Assessment!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection