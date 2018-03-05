@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('users');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>


@section('body')

<br> 
<br>
<br> 
<br>

<h1>Showing {{ $user->first_name }} {{ $user->last_name }}</h1>

<?php 
    
    $pp = asset( $profile_photo);
    $cup = asset( $current_user_photo);
    
?>

<p>Current User: </p>
<img style="height: 50px; width: 50px; border-radius: 50%;" src="{{$cup}}">

<p>Profile Photo: </p>
<img style="height: 50px; width: 50px; border-radius: 50%;" src="{{$pp}}">

    <!--
    <div class="jumbotron text-center">
        <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
        
        <p>
            <strong>Email:</strong> {{ $user->email }}<br>
            <strong>Hiring Date:</strong> {{ $user->hiring_date }}<br>
            <strong>Birth Date:</strong> {{ $user->birth_date }}<br>
            <strong>Department:</strong> {{ $user->department }}<br>
            <strong>SUpervisor ID:</strong> {{ $user->supervisor_id }}<br>
            <strong>Position:</strong> {{ $user->position }}<br>
            <strong>Manager?:</strong> {{ $user->manager_check }}<br>
        </p>

    </div>
     -->

<h1> Statistics </h1>


<h3> Quizzes </h3>

    @foreach($skills_quiz as $key => $skill)
       <p> Skill: {{$skill->name}} </p>
    
       @foreach($section_attempts as $key => $section_attempt)
                @foreach($sections as $key => $section)
                    @if(($section_attempt->section_id==$section->id)AND($section->skill_id==$skill->id))
                       <p>___{{$section_attempt->score}} / {{$section_attempt->max_score}} </p>
                    @endif
                @endforeach       
        @endforeach
    @endforeach
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           

<h3> Assessments </h3>

    @foreach($skills_assessment as $key => $skill)
       <p> Skill: {{$skill->name}} </p>
    
       @foreach($user_assessments as $key => $user_assessment)
                @foreach($assessments as $key => $assessment)
                    @if(($user_assessment->assessment_id==$assessment->id)AND($assessment->skill_id==$skill->id))
                       <p>___Rating: {{$user_assessment->rating}} </p>
                       <p>___Feedback: {{$user_assessment->feedback}} </p>
                    @endif
                @endforeach       
        @endforeach
    @endforeach






@endsection