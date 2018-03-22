@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')

<h1>Showing {{ $question->id }}</h1>

    <div class="jumbotron text-center">
        <h2>Question: {{ $question->question_item }} </h2>
        <p>
            <strong>Answer:</strong> {{ $question->answer_item }}<br>
        </p>
    </div>


@endsection