@extends('templates.newsletter-master')

@section('body')

<h1>Training Session about {{ $training_session->title }} </h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Date:</strong> {{ $training_session->date }}<br>
            <strong>Starting Time:</strong> {{ $training_session->starting_time }}<br>
            <strong>Ending Time:</strong> {{ $training_session->ending_time }}<br>
            <strong>Speaker:</strong> {{ $training_session->speaker }}<br>
            <strong>Venue:</strong> {{ $training_session->venue }}<br>
            
        </p>
    </div>

@endsection