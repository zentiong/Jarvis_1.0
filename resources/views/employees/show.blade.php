@extends('templates.newsletter-master')

@section('body')
<h1>Showing {{ $employee->first_name }} {{ $employee->last_name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $employee->first_name }} {{ $employee->last_name }}</h2>
        <p>
            <strong>Email:</strong> {{ $employee->email }}<br>
            <strong>Hiring Date:</strong> {{ $employee->hiring_date }}<br>
            <strong>Birth Date:</strong> {{ $employee->birth_date }}<br>
            <strong>Department:</strong> {{ $employee->department }}<br>
            <strong>SUpervisor ID:</strong> {{ $employee->supervisor_id }}<br>
            <strong>Position:</strong> {{ $employee->position }}<br>
            <strong>HR?:</strong> {{ $employee->hr_check }}<br>
            <strong>Manager?:</strong> {{ $employee->manager_check }}<br>
        </p>
    </div>

</div>
@endsection