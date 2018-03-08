@extends('templates.dashboard-master')
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

@section('body')

<br>

<br>

<br>
<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 
$user_id = Auth::user()->id;
?>



<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Quiz ID</td>
            <td>Topic</td>
        </tr>
    </thead>
    <tbody>
    @foreach($quizzes as $key => $quiz)
        <tr>
            <td>{{ $quiz->quiz_id }}</td>
            <td>{{ $quiz->topic }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>
            <?php
                $taken = false;
            ?>
            <!-- Error! -->
                @foreach($user_quizzes as $key => $user_quiz)
                    
                <?php
                    if(($user_quiz->user_id==$user_id)and($quiz->quiz_id==$user_quiz->quiz_id))
                    {
                        $taken = true;
                    }

                ?>

                @endforeach
                @if($taken == false)
                 <a class="btn btn-small btn-info" href="{{ URL::to('quizzes/' . $quiz->quiz_id . '/take') }}">Take this Quiz</a>
                @else
                <a class="btn btn-small btn-info" >Already Taken :( Hanap ka nalang ng iba. Sad life bro.</a>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection