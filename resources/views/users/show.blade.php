@extends('templates.newsletter-master')

@section('body')

<h1>Showing {{ $user->first_name }} {{ $user->last_name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
        <p>
            <strong>Email:</strong> {{ $user->email }}<br>
            <strong>Hiring Date:</strong> {{ $user->hiring_date }}<br>
            <strong>Birth Date:</strong> {{ $user->birth_date }}<br>
            <strong>Department:</strong> {{ $user->department }}<br>
            <strong>SUpervisor ID:</strong> {{ $user->supervisor_id }}<br>
            <strong>Position:</strong> {{ $user->position }}<br>
            <strong>Manager?:</strong> {{ $user->manager_check }}<br>
        </p>
    </div>

@endsection