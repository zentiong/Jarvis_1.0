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

                <!-- delete the quiz (uses the destroy method DESTROY /quizzes/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                    {{ Form::open(array('url' => 'quizzes/' . $value->quiz_id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Quiz', array('class' => 'btn btn-warning')) }}
                 {{ Form::close() }}
                <!-- show the quiz (uses the show method found at GET /quizzes/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('quizzes/' . $value->quiz_id) }}">Show this Quiz</a>

                <!-- edit this quiz (uses the edit method found at GET /quizzes/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('quizzes/' . $value->quiz_id . '/edit') }}">Edit this Quiz</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection