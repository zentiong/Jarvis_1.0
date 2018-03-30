@extends('templates.dashboard-master')


@section('body')
<main class="container create-page">
  <section class="row crud-page-top">
      <div>
        <h1 class="crud-page-title">Training</h1>
      </div>
      <a href="{{ URL::to('trainings') }}" class="btn cancel-btn">Back to All Trainings</a>
  </section>
  <hr>
  <section class="container dashboard-container">
    <div class="row dashboard-body">
        <div class="dashboard-content">
            
            <div class="row show-training-details">
                <div class="col-md-6 flex-column-center">
                  <h5 class="training-title">{{ $training->title }}</h5>
                </div>
                
                <div class="col-md-6">
                  <div class="row date">
                    <i class="fa fa-calendar-o"></i>
                    <div class="text-center">
                      <h6>{{ date('F d, Y', strtotime($training->date)) }}</h6>
                      <small>DATE</small>
                    </div>
                  </div>
                  <div class="row time">
                    <i class="fa fa-clock-o"></i>
                    <div class="text-center">
                      <span>
                        <h6>{{ date('h:i A', strtotime($training->starting_time)) }}</h6>
                        <small class="start-time">START</small>
                      </span>
                      &nbsp;&ndash;
                      <span>
                        <h6>{{ date('h:i A', strtotime($training->ending_time)) }}</h6>
                        <small class="end-time">END</small>
                      </span>
                    </div>
                  </div>
                  <div class="row speaker">
                    <i class="fa fa-id-card"></i>
                    <div class="text-center">
                      <h6>{{ $training->speaker }}</h6>
                      <small>SPEAKER</small>
                    </div>
                  </div>
                  <div class="row venue">
                    <i class="fa fa-flag"></i>
                    <div class="text-center">
                      <h6>{{ $training->venue }}</h6>
                      <small>VENUE</small>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sorting -->
    <?php
      $invited = array();
      $going = array();
      $nottendees = array();
    ?>  
    
    @foreach($user_trainings as $key => $user_training)
      @foreach($users as $key => $user)
        @if($user_training->user_id == $user->id)
          <?php
            $temp = $user;
          ?>
        @endif
      @endforeach
    @if($user_training->confirmed == false)
      <?php
        array_push($invited, $temp)
      ?>
    @else
      <?php
        array_push($going, $temp)
      ?>
    @endif
    @endforeach


    <div class="row dashboard-body">
        <div class="dashboard-content">
            <h6 class="content-header light">
                <strong>Attendance</strong>
            </h6>
            <div class="row">
                <div class="col-md-4">
                    <h6 class="content-header light"> Invited </h6>
                </div>
            
                <div class="col-md-4">
                    <h6 class="content-header light"> Going </h6>
                </div>    

                <div class="col-md-4">
                    <h6 class="content-header light"> Attended</h6>
                 </div>
           </div>
           <div class="row" style="padding-top: 0em">
                <div class="col-md-4">
                      @foreach($invited as $key => $user)
                      {{$user->first_name}} {{$user->last_name}}<br>
                      @endforeach
                </div>           
           
                <div class="col-md-4">
                      @foreach($going as $key => $user)
                      {{$user->first_name}} {{$user->last_name}}<br>
                      @endforeach
                </div>
                <div class="col-md-4">
                      @foreach($attendees as $key => $user)
                      {{$user->first_name}} {{$user->last_name}}<br>
                      @endforeach
                </div>
                
           </div>

        </div>
    </div>
    <div class="row dashboard-body">
        <div class="dashboard-content">
            <h6 class="content-header light">
                <strong>Respondents</strong>
            </h6>
            <div class="row">
                <div class="col-md-12"><center>
                <?php 
                  $counter = 0;
                ?>
                @foreach($user_trainings as $key => $user_training)
                  @if($user_training->rating_training!=NUll)
                    <?php 
                      $counter++;
                    ?>
                  @endif
                @endforeach
                @if($counter != 0)
                <h4>{{$counter}}</h4>
                @else
                <h4>None</h4>
                @endif    
                </div>
            </div>
        </div>
    </div>
     <div class="row dashboard-body">
        <div class="dashboard-content">
            <h6 class="content-header light">
                <strong>Training Rating</strong>
            </h6>
            <div class="row">
                <div class="col-md-12"><center>
                <?php 
                  $average_rating_training = 0;
                  $counter = 0;
                ?>
                @foreach($user_trainings as $key => $user_training)
                  @if($user_training->rating_training!=NUll)
                    <?php 
                      $average_rating_training += $user_training->rating_training;
                      $counter++;
                    ?>
                  @endif
                @endforeach
                @if($counter != 0)
                <h4>{{$average_rating_training/$counter}}</h4>
                @endif    
                </div>
            </div>
        </div>
    </div>
     <div class="row dashboard-body">
        <div class="dashboard-content">
            <h6 class="content-header light">
                <strong>Speaker Rating</strong>
            </h6>
            <div class="row">
                <div class="col-md-12"><center>
                <?php 
                  $average_rating_speaker = 0;
                  $counter = 0;
                ?>
                @foreach($user_trainings as $key => $user_training)
                  @if($user_training->rating_speaker!=NUll)
                    <?php 
                      $average_rating_speaker += $user_training->rating_speaker;
                      $counter++;
                    ?>
                  @endif
                @endforeach
                 @if($counter != 0)
                <h4>{{$average_rating_speaker/$counter}}</h4>
                  @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row dashboard-body">
        <div class="dashboard-content">
            <h6 class="content-header light">
                <strong>Evaluations</strong>
            </h6>
            <div class="row">
                <div class="col-md-12"><center>
                @foreach($user_trainings as $key => $user_training)
                  @if($user_training->evaluation!=NUll)
                    <p>{{$user_training->evaluation}} </p>
                  @endif
                @endforeach
                    
                </div>
            </div>
        </div>
    </div>
  </section>
</main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('training-sessions');
        a.classList.toggle("active");
    });

</script>
