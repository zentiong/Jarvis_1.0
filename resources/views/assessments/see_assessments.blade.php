@extends('templates.dashboard-master')

@section('body')


<?php 
$user_id = Auth::user()->id; /* Supervisor */
?>

 <main class="container create-page">
        <section class="row crud-page-top">
            <h1 class="crud-page-title">See Assessment</h1>
            <a class="btn crud-main-cta" href="{{ URL::to('make_assessments') }}">Create Another Assessment</a>
        </section>
            <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif


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
                @foreach($assessments as $key => $assessment)
                    @if($value->assessment_id == $assessment->id)
                    @foreach($skills as $key => $skill)
                        @if($skill->id == $assessment->skill_id)
                            {{$skill->name}}
                        @endif
                    @endforeach
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
                {{ $value->rating }} / 5
            </td>
            <td>
                 {{ $value->feedback }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</main>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>