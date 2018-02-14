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
            <td>Employee Name</td>
            <td>Rating</td>
            <td>Feedback</td>
        </tr>
    </thead>
    <tbody>
    @foreach($user_assessments as $key => $value)
        <tr>
            <td>
                @foreach($assessments as $key => $topic)
                <?php

                    $check_assessment_id = $topic->id;

                ?>

                @if($check_assessment_id == $value->assessment_id)
                   {{ $topic->topic }}
                @endif

                @endforeach
            </td>
            <td>
                 @foreach($users as $key => $user)
                <?php

                    $check_user_id = $user->id;

                ?>

                @if($check_user_id == $value->employee_id)
                   {{ $user->first_name }} {{ $user->last_name }}
                @endif

                @endforeach
            </td>
            <td>
                {{ $value->rating }}
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