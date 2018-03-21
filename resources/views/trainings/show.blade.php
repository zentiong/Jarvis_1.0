@extends('templates.dashboard-master')

@section('body')
<main class="container create-page">
  <section class="row crud-page-top">
      <h1 class="crud-page-title">Showing Training {{ $training->title }}</h1>
  </section>
  <section class="container dashboard-container">
    <div class="row dashboard-body">
        <div class="dashboard-content">
            <h6 class="content-header light">
                <strong>{{ $training->title }}</strong>
            </h6>
            <div class="row">
                <div class="col-md-12"><center>
                    <strong>Date:</strong> {{ $training->date }}<br>
                    <strong>Starting Time:</strong> {{ $training->starting_time }}<br>
                    <strong>Ending Time:</strong> {{ $training->ending_time }}<br>
                    <strong>Speaker:</strong> {{ $training->speaker }}<br>
                    <strong>Venue:</strong> {{ $training->venue }}<br></center>
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
