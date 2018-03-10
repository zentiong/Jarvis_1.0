@extends('templates.dashboard-master') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
	 $(document).ready(function() {
        var a = document.getElementById('levels');
        a.classList.toggle("active");
    });

	 // enables Bootstrap tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@section('body')

	<main class="container-fluid">
		<section class="container-fluid">
			@if (Session::has('message'))
			    <div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif

			<?php 
			$current_user = Auth::user();
			$current_id = Auth::user()->id;



			?>
             <section class="row personal-details hr-pastel">
            <div class="inner">
                <img class="img-circle profile-picture" src="{{ asset('images/hr-corp/DL.png') }}" alt="Your profile picture">
                <div class="user-details">
                     @auth
                    <h1 class="username-title">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                    <h6>{{ Auth::user()->position }}</h6>
                    <h6>{{ Auth::user()->department }}</h6>
                    <br>
                    <h6>{{ Auth::user()->email }}</h6>
                    @endauth
                </div>
            </div>
            
        </section>


			<p>NORMAL EMPLOYEE LANDING</p>
			<button onclick="update_data(myChart,relevant)">Relevant Skills</button>
            <button onclick="update_data(myChart,alls)">All Skills</button>
            <canvas id="myChart" width=100 height=500></canvas>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
            <script type="text/javascript">

                let relevant = [14,15,67,89,23,56,23,56,78]
                let alls = [12, 19, 3, 5, 2, 3]


                function update_data(chart, data) 
                {
                    chart.data.datasets[0].data = data;
                    chart.update();
                }

                Chart.defaults.global.maintainAspectRatio = false;
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                        datasets: [{
                            label: 'Relevant Skills',
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            </script>
		</section>
	</main>

    <p>--------------------------------------------------------</p>

<h1> Trainings Recommended to you</h1>
    
    @foreach($trainings_personal as $key => $training)
        <div style="border: 1px solid red;">
            <h6> Training </h6>
            <p>Title: {{$training->title}}</p>
            <p>Date: {{$training->date}}</p>
            <p>Venue: {{$training->venue}}</p>
        @foreach($user_trainings as $key => $user_training)
            @if($user_training->training_id == $training->id) 
                @if($user_training->confirmed == false)
                    {{ Form::open(array('url' => 'confirm')) }}
                    {{ Form::hidden('training_id', $value = $training->id) }}
                    {{ Form::hidden('user_id', $value = Auth::user()->id) }}
                    {{ Form::submit('Confirm Slot', array('class' => 'btn btn-primary create-btn text-center')) }}
                    {{ Form::close() }}
                @else
                    <div style="border: 1px solid blue; width: 100px; height: 30px;">
                        <h6>Going</h6>
                    </div>
                @endif               
            @endif
        @endforeach
        </div>
    @endforeach

<h1> Incoming Trainings</h1>

    <!-- Different Logic -->

    @foreach($trainings_general as $key => $training)
        {{ $present = false }} 
        <div style="border: 1px solid red;">
            <h6> Training </h6>
            <p>Title: {{$training->title}}</p>
            <p>Date: {{$training->date}}</p>
            <p>Venue: {{$training->venue}}</p>
        @foreach($user_trainings as $key => $user_training)
            @if($user_training->training_id == $training->id) 
                <?php
                    $present = true 
                ?>
            @endif
        @endforeach
        @if($present==false) 
            {{ Form::open(array('url' => 'signup')) }}
            {{ Form::hidden('user_id', $value = Auth::user()->id) }}
            {{ Form::hidden('training_id', $value = $training->id) }}
            {{ Form::submit('Confirm Slot', array('class' => 'btn btn-primary create-btn text-center')) }}
            {{ Form::close() }}
        @else
            @if($user_training->confirmed == true)
                 <div style="border: 1px solid blue; width: 100px; height: 30px;">
                    <h6>Going</h6>
                </div> 
            @endif
        @endif
        </div>
    @endforeach

    <p>--------------------------------------------------------</p>

        <h1> Quizzes you ought to take</h1>
        <?php
            $quizzes_to_take = array();
            $user_trainings_taken = array();
            $trainings_taken = array();
        ?>

        @foreach($user_trainings as $key => $user_training)
            @if(($user_training->user_id == $current_id)and($user_training->confirmed == true))
                <?php
                    array_push($user_trainings_taken, $user_training)
                ?>
            @endif
        @endforeach

        @foreach($trainings as $key => $training)
            @foreach($user_trainings_taken as $key => $user_training_taken)
                @if($training->id == $user_training_taken->training_id)
                    <?php
                    array_push($trainings_taken, $training)
                    ?>
                @endif
            @endforeach
        @endforeach

        @foreach($trainings_taken as $key => $training_taken)
            @foreach($quizzes as $key => $quiz)
                @if($training_taken->id == $quiz->training_id)
                    <?php
                        array_push($quizzes_to_take, $quiz)
                    ?>
                @endif
            @endforeach        
        @endforeach


        <div style="border: 1px solid blue;">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Topic</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            @foreach($quizzes_to_take as $key => $quiz_to_take)
                <tr>
                    <td>{{ $quiz_to_take->topic }}</td>
                    <td>
                        <?php
                            $taken = false;
                        ?>
                        @foreach($user_quizzes as $key => $user_quiz)
                        <?php
                            if(($user_quiz->user_id==$current_id)and($quiz_to_take->quiz_id==$user_quiz->quiz_id))
                            {
                                $taken = true;
                            }
                        ?>
                        @endforeach
                        @if($taken == false)
                         <!-- 
                            <a class="btn btn-small btn-info" href="{{ URL::to('quizzes/' . $quiz_to_take->quiz_id . '/take') }}">Take this Quiz</a>
                         -->

                         <button class="btn btn-small btn-info" type="button" data-toggle="modal" <?php echo 'data-target="'.'#'.$quiz_to_take->quiz_id.'"'?>>Take this Quiz</button>
                        @else
                        <a class="btn btn-small btn-info" >Already Taken :( Hanap ka nalang ng iba. Sad life bro.</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>

    @if(!empty($quizzes_to_take))
    <div class="modal fade" <?php echo 'id="'.$quiz_to_take->quiz_id.'"'?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Password:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                {{ Form::open(array('url' =>'verify_pw' )) }}
                        <div class="form-group">

                      {{ Form::label('password', 'Password') }}
                      {{ Form::text('password', Request::old('password'), array('class' => 'form-control')) }}
                  </div>
                  <?php
                  $v =  $quiz_to_take->quiz_id 
                  ?>

                {{ Form::hidden('quiz_id', $value = $v) }}

              <div class="modal-footer create-bottom-wrapper">
                <a href="{{ URL::to('levels') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
                {{ Form::submit('Submit', array('class' => 'btn btn-primary create-btn text-center')) }}
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
    </div>
    @endif

 <h6> Quizzes </h6>
    @foreach ($trainings_attended as $key)
        <p>Training {{$key->title}}</p>
    
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
    @endforeach

@endsection