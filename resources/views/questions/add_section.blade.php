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

    <?php
        $section_skills = array();
    ?>

    @foreach($sections as $key => $section)
    <?php
        array_push($section_skills, $section->skill_id)
    ?>
    @endforeach

{{ Form::open(array('url' => 'quizzes/'.$quiz_id.'/store_section')) }}

    <div id="div1">
        <div class="form-group">
            {{ Form::label('skill', 'Skill') }}
    		<select id="skill_id" class="form-control" name="skill_id">
       		@foreach($skills as $key => $skill)
                <?php
                    $taken = false;
                ?>
                @foreach($section_skills as $key => $section_skill)
                    @if($skill->id == $section_skill)
                    <?php
                        $taken = true;
                    ?>
                    @endif
                @endforeach
                @if($taken == false)
                    <option value="<?php echo $skill->id ?>">{{$skill->name}}</option>
                @endif
       		@endforeach
        </div>
    </div>



    <br>
    {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    
{{ Form::close() }}


@endsection