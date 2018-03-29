@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">Results</h1>
            </div>
            <a href="{{ url()->previous() }}" class="btn cancel-btn">Go Back</a>
        </section>
        <section>
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info" role="alert">
                    <strong>Heads up</strong>
                    {{ Session::get('message') }}
                </div>
            @endif

            <?php 
            $user_id = Auth::user()->id; /* Supervisor */
            ?>


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
        </section>
    </main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('quizzes');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
</script>