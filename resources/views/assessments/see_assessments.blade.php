@extends('templates.newsletter-master')

@section('body')

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 
$user_id = Auth::user()->id; /* Supervisor */
?>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Assessment Topic</td>
            <td>Assessment ID</td>
            <td>Employee Name</td>
            <td>Employee ID</td>
            <td>Rating</td>
            <td>Feedback</td>
        </tr>
    </thead>
    <tbody>
    @foreach($user_assessments as $key => $value)
        <tr>
            <td>
                @foreach(assessments as $key => $topic)
                Topic {{ $topic->topic }}
                @endforeach
            </td>
            <td>
                {{ $value->employee_id }}
            </td>
            <td>
                Name {{ $value->assessment_id }}
            </td>
            <td>
                {{ $value->employee_id }}
            </td>
            <td>
                Rating: {{ $value->rating }}
            </td>
            <td>
                 {{ $value->feedback }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection