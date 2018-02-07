@extends('templates.newsletter-master')

@section('body')

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 
$user_id = Auth::user()->id;
$taken = false;
?>



<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Quiz ID</td>
            <td>Topic</td>
        </tr>
    </thead>
    <tbody>
    @foreach($quizzes as $key => $value)
        <tr>
            

            <td>{{ $value->quiz_id }}</td>
            <td>{{ $value->topic }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                @foreach($user_quizzes as $key => $check)
                <?php 

                $taken = false;

                $check_user = $check->user_id;
                $check_quiz = $check->quiz_id;

                $quiz_id = $value->quiz_id;

                if(($check_user==$user_id)and($check_quiz==$quiz_id))
                {
                    $taken = true;
                }



                ?>
                @endforeach
                @if($taken == false)
                 <a class="btn btn-small btn-info" href="{{ URL::to('quizzes/' . $value->quiz_id . '/take') }}">Take this Quiz</a>
                @else
                <a class="btn btn-small btn-info" >No Entry</a>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection