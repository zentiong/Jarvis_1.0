@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 
$user_id = Auth::user()->id; /* Supervisor */
?>


<br>
<br><br>
<br>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Quiz</td>
            <td>Employee Name</td>
            <td>Score</td>
        </tr>
    </thead>
    <tbody>
    @foreach($user_quiz as $key => $value)
        <tr>
            <td>
                @foreach($quizzes as $key => $quiz)
                <?php

                    $check_quiz_id = $quiz->quiz_id;

                ?>

                @if($check_quiz_id == $value->quiz_id)
                   {{ $quiz->topic }}
                @endif

                @endforeach
            </td>
            <td>
                 @foreach($users as $key => $user)
                <?php

                    $check_user_id = $user->id;

                ?>

                @if($check_user_id == $value->user_id)
                   {{ $user->first_name }} {{ $user->last_name }}
                @endif

                @endforeach
            </td>
            <td>
                {{ $value->score }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection