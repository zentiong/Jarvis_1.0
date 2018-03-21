@extends('templates.dashboard-master')

@section('body')
    
    <main class="container create-page">
        <section class="row crud-page-top">
             @if (Session::has('message'))
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif
            <?php 
                $check = $user->profile_photo;
    
                if($check!=null)
                {
                    $pp = asset( 'images/profile_photos/'.$user->profile_photo);
                }
                else 
                {
                    $pp = asset( 'images/profile_photos/default.png');
                }
            ?>
            <h1 class="crud-page-title">Showing employee</h1>
        </section>
        <section class="container dashboard-container">
            <div class="row dashboard-body">
                <div class="dashboard-content">
                    <h6 class="content-header light">
                        <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Profile picture:</strong></p>
                            <div class="img-circle profile-picture" style="background-image: url('{{ $pp }}')" alt="Your profile picture"></div>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email address:</strong> {{ $user->email }}</p>
                            <p><strong>Hiring Date:</strong> {{ $user->hiring_date }}<br>
                            <strong>Birth Date:</strong> {{ $user->birth_date }}</p>
                            <strong>Department:</strong> {{ $user->department }}<br>
                            <strong>Supervisor ID:</strong> {{ $user->supervisor_id }}<br>
                            <strong>Position:</strong> {{ $user->position }}<br>
                            <strong>Manager?</strong> {{ $user->manager_check }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row dashboard-body">
                <div class="dashboard-content">
                    <h6 class="content-header light">
                        <strong>Statistics</strong>
                    </h6>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Quizzes</p>
                            @foreach($skills_quiz as $key => $skill)
                            <p>Skill: {{$skill->name}}</p>
                                @foreach($section_attempts as $key => $section_attempt)
                                    @foreach($sections as $key => $section)
                                        @if(($section_attempt->section_id==$section->id)AND($section->skill_id==$skill->id))
                                        <p>___{{$section_attempt->score}} / {{$section_attempt->max_score}} </p>
                                        @endif
                                    @endforeach       
                                @endforeach
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <p>Assessments</p>
                            @foreach($skills_assessment as $key => $skill)
                            <p>Skill: {{$skill->name}}</p>
                                @foreach($user_assessments as $key => $user_assessment)
                                    @foreach($assessments as $key => $assessment)
                                        @if(($user_assessment->assessment_id==$assessment->id)AND($assessment->skill_id==$skill->id))
                                            <p>___Rating: {{$user_assessment->rating}} </p>
                                            <p>___Feedback: {{$user_assessment->feedback}} </p>
                                        @endif
                                    @endforeach       
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row dashboard-body">
                <div class="dashboard-content">
                    <h6 class="content-header light"><b>Trainings recommended to {{ $user->first_name }} {{ $user->last_name }}</b></h6>
                    
                            
                            @foreach($trainings as $key => $training)
                                @if($training->date >= $now) 
                                <div class="trainings-box">
                                <div>
                                    <!-- text -->
                                    <p><b>{{$training->title}}</b></p>
                                    <span>
                                        {{date('h:i', strtotime($training->starting_time))}}
                                    </span>
                                    <span>
                                        - {{date('h:i a', strtotime($training->ending_time))}}</span>
                                    <span>
                                        | {{date('F d', strtotime($training->date))}}
                                    </span>
                                    <p>{{$training->venue}}</p>
                                </div>
                                </div>
                                @endif
                                
                            @endforeach
                      
                </div>
            </div>
        </section>

    </main>








@endsection

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