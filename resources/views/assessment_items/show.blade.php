@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')

<h1>Showing {{ $assessment_item->id }}</h1>

    <div class="jumbotron text-center">
        <h2>Criteria: {{ $assessment_item->criteria }} </h2>
    </div>


@endsection