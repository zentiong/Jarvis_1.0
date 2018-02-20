@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')

<br>
<br>
<br>
<br>

<h1>Add Section</h1>
<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'quizzes/'.$quiz_id.'/store_section')) }}

    <div id="div1">
        <div class="form-group">
            {{ Form::label('skill', 'Skill') }}
    		<select id="skill_id" class="form-control" name="skill_id">
 
       		@foreach($skills as $key => $value)
            	<option value="<?php echo $value->id ?>">{{$value->name}}</option>
       		@endforeach

        </div>
    </div>



    <br>
    {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    
{{ Form::close() }}


@endsection