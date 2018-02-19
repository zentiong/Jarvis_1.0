@extends('templates.dashboard-master')

@section('body')

<h1>Information about {{ $position->name }} </h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Name:</strong> {{ $position->name }}<br>
            <strong>Current Employees:</strong><br>
            
        </p>
    </div>

@endsection