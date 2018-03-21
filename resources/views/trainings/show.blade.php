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
                <div class="col-md-6">
                    <strong>Date:</strong> {{ $training->date }}<br>
                    <strong>Starting Time:</strong> {{ $training->starting_time }}<br>
                    <strong>Ending Time:</strong> {{ $training->ending_time }}<br>
                    <strong>Speaker:</strong> {{ $training->speaker }}<br>
                    <strong>Venue:</strong> {{ $training->venue }}<br>
                </div>
            </div>
        </div>
    </div>

  </section>
</main>



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
    		
   	<h5> Invited </h5>
   	<ul>
   		@foreach($invited as $key => $user)
   		<li>{{$user->first_name}} {{$user->last_name}}</li>
   		@endforeach
   	</ul>

   	<h5> Going </h5>
   	<ul>
   		@foreach($going as $key => $user)
   		<li>{{$user->first_name}} {{$user->last_name}}</li>
   		@endforeach
   	</ul>

    <h5> Attended (Taken Quiz)</h5>

    <ul>

      @foreach($attendees as $key => $user)
      <li>{{$user->first_name}} {{$user->last_name}}</li>
      @endforeach
    </ul>

    @foreach ($going as $key => $goer) 
      @if(!in_array($goer, $attendees))
        <?php 
          array_push($nottendees, $goer)
        ?>
      @endif
    @endforeach
      

     <h5> Not taken quiz yet OR pakingshet people who said they were going but really didn't </h5>

    <ul>
      @foreach($nottendees as $key => $user)
      <li>{{$user->first_name}} {{$user->last_name}}</li>
      @endforeach
    </ul>

    <h2> Evaluations </h2>
    	
    
    @foreach($user_trainings as $key => $user_training)
      @if($user_training->evaluation!=NUll)
        <p>{{$user_training->evaluation}} </p>
      @endif
    @endforeach
    
@endsection
