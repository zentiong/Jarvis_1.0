@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')

<h1>Event about {{ $training->title }} </h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Date:</strong> {{ $training->date }}<br>
            <strong>Starting Time:</strong> {{ $training->starting_time }}<br>
            <strong>Ending Time:</strong> {{ $training->ending_time }}<br>
            <strong>Venue:</strong> {{ $training->venue }}<br>
            
        </p>
    </div>

@endsection