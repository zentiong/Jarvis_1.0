@extends('templates.dashboard-master') 

@section('body')
<br>
<br>
<br>
<br>

<h6> Quizzes </h6>
    @foreach($trainings_attended as $key => $training)
        <p>Training {{$training->title}}</p>
        @foreach($quiz as $key => $q)
          	@if($q->training_id == $training->id)
          		@foreach($user_quizzes as $key => $z)
          			@if($z->quiz_id == $q->quiz_id)
        			<p> Quiz Topic: {{$q->topic}}   Score: {{$z->score}}/{{$z->max_score}}</p>
        			@endif
        		@endforeach
        	@endif

        @endforeach
    	

    @endforeach

@endsection