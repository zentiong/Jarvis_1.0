@extends('templates.dashboard-master') 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>

    <script type="text/javascript">
        // enables dynamic navbar
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
                    <h1 class="username-title">{{ $current_user ->first_name }} {{ $current_user ->last_name }}</h1>
                    <h6>{{ $current_user->position }}</h6>
                    <h6>{{ $current_user->department }}</h6>
                    <br>
                    <h6>{{ Auth::user()->email }}</h6>
                    @endauth
                </div>
            </div>
        </section>

        <section class="container dashboard-container">
            <!-- TAB CONTAINER -->
            <div class="row dashboard-tab-container">
                <button class="btn tablinks" onclick="openTab(event, 'personal')">Personal</button>
                <button class="btn tablinks"  onclick="openTab(event, 'non-personal')">Company-wide</button>
            </div>
            <!-- PERSONAL CONTENT CONTAINER -->
            <div class="row dashboard-body tabcontent" id="personal">
                <div class="col-md-7">
                    <h5 class="dashboard-header">Skills</h5>
                    <div class="dashboard-content">
                        <button onclick="update_data(myChart,relevant)">Relevant Skills</button>
                        <button onclick="update_data(myChart,alls)">All Skills</button>
                        <canvas id="myChart"></canvas>

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
                    </div>
                </div>
                <div class="col-md-5">
                    <h5 class="dashboard-header">Trainings</h5>
                    <div class="dashboard-content">
                        <div class="recommended-wrapper">
                            <h6 class="content-header"><b>Recommended Trainings</b></h6>
                            @foreach($trainings_personal as $key => $training)
                                <div class="trainings-box">
                                    <div>
                                        <!-- text -->
                                        <p><b>{{$training->title}}</b></p>
                                        <span>{{date('h:i a', strtotime($training->starting_time))}}</span>
                                        <span>{{
                                            $training->date}}</span>
                                        <p>
                                            {{$training->venue}}
                                        </p>
                                    </div>
                                    <div>
                                        <!-- button -->
                                        @foreach($user_trainings as $key => $user_training)
                                        @if($user_training->training_id == $training->id) 
                                            @if($user_training->confirmed == false)
                                                {{ Form::open(array('url' => 'confirm', 'style' => 'margin: 0')) }}
                                                {{ Form::hidden('training_id', $value = $training->id) }}
                                                {{ Form::hidden('user_id', $value = Auth::user()->id) }}
                                                {{ Form::submit('SIGN UP', array('class' => 'btn text-center')) }}
                                                {{ Form::close() }}
                                            @else
                                                <span class="going-state">&#x2713;   I'M GOING</span>
                                            @endif             
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="dashboard-content">
                        <div class="incoming-wrapper">
                            <h6 class="content-header"><b>Trainings this month</b></h6>
                            @foreach($trainings_general as $key => $training)
                                {{ $present = false }} 
                                <div class="trainings-box">
                                    <!-- text -->
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
                                         <div class="going-state">
                                            <h6>Going</h6>
                                        </div> 
                                    @endif
                                @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- NON-PERSONAL CONTENT CONTAINER -->
            <div class="row dashboard-body tabcontent" id="non-personal">
                <div class="col-md-7">
                    <h5 class="dashboard-header">Overall skills statistics</h5>
                    <div class="dashboard-content">
                    </div>
                </div>
                <div class="col-md-5">
                    <h5 class="dashboard-header">Overall training statistics</h5>
                    <div class="dashboard-content">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>Title</td>
                                    <td>Speaker</td>
                                    <td>Venue</td>
                                    <td class="no-stretch">Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($trainings as $key => $value)
                                <tr>
                                    <td>{{ $value->date }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->speaker }}</td>
                                    <td>{{ $value->venue }}</td>

                                    <!-- we will also add show, edit, and delete buttons -->
                                    <td class="table-actions no-stretch">

                                        <!-- show the employee (uses the show method found at GET /employees/{id} -->
                                        <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View employee" href="{{ URL::to('users/' . $value->id) }}">
                                            <i class="fa fa-user fa-lg"></i>
                                        </a>

                                        <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                                        <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit employee" href="{{ URL::to('users/' . $value->id . '/edit') }}">
                                             <i class="fa fa-pencil fa-lg"></i>
                                        </a>

                                        <!-- delete the employee (uses the destroy method DESTROY /employees/{id} -->
                                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                                            {{ Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <div data-toggle="tooltip" data-placement="bottom" title="Delete employee" data-animation="true">
                                                {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                                            </div>

                                         {{ Form::close() }}
                                        

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>  
                        <a class="crud-main-cta" href="trainings/create">&#43; Add Training</a> 
                    </div>
                </div>
            </div>
    
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
                         <?php /*

                         <button class="btn btn-small btn-info" type="button" data-toggle="modal" <?php echo 'data-target="'.'#'.$quiz_to_take->quiz_id.'"'?>>Take this Quiz</button>
                         
                         */?>

                           <button class="btn btn-small btn-info" type="button" data-toggle="modal" data-target="chicken">Take this Quiz</button>
                        @else
                        <a class="btn btn-small btn-info" >Already Taken :( Hanap ka nalang ng iba. Sad life bro.</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>

    <?php /* @if(!empty($quizzes_to_take)) */ ?>
    <div class="modal fade" id="chicken" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <?php /* @endif */ ?>
        </section>

    </main>
@endsection