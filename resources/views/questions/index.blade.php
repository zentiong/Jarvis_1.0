@extends('templates.newsletter-master')

@section('body')

<h2> Showing questions of this quiz ({{ $quiz->topic }} ) </h2>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

 <a href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/questions/create') }}" style="float: right;">Add a Question</a>
 <br>
 <br>

    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Quiz ID</td>
            <td>Question ID</td>
            <td>Question</td>
            <td>Answer </td>
           
        </tr>
    </thead>

    <tbody>
    @foreach($questions as $key => $value)
        <tr>
            <td>{{ $value->quiz_id }}</td>
            <td>{{ $value->id }}</td>
            <td>{{ $value->question_item }}</td>
            <td>{{ $value->answer_item }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the quiz (uses the destroy method DESTROY /quizzes/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                    {{ Form::open(array('url' => 'quizzes/'.$quiz->quiz_id.'/questions/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Remove', array('class' => 'btn btn-warning')) }}
                 {{ Form::close() }}
                <!-- show the quiz (uses the show method found at GET /quizzes/{id} -->
                <!-- -->
                <a class="btn btn-small btn-success" href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/questions/'.$value->id) }}">Show this Question</a>
               
                <!-- edit this quiz (uses the edit method found at GET /quizzes/{id}/edit -->
                <!-- -->
                <a class="btn btn-small btn-info" href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/questions/'.$value->id.'/edit') }}">Edit this Question</a>
                
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
   

@endsection