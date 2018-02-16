@extends('templates.dashboard-master')

@section('body')

<h1>Showing {{ $assessment_item->id }}</h1>

    <div class="jumbotron text-center">
        <h2>Criteria: {{ $assessment_item->criteria }} </h2>
    </div>


@endsection