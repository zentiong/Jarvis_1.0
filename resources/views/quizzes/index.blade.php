@extends('templates.dashboard-master')

@section('body')
    <main class="container-fluid">
        <section class="container-fluid">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">All Quizzes</h1>
                <a href="{{ URL::to('quizzes/create') }}" class="btn crud-main-cta">&#43; Add Quiz</a>
            </div>

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
                        <td class="table-actions">

                            <!-- show the quiz (uses the show method found at GET /quizzes/{id} -->
                            <a class="btn show-btn" title="Show quiz" href="{{ URL::to('quizzes/' . $value->quiz_id) }}">
                                <i class="fa fa-user fa-lg"></i>
                            </a>

                            <!-- edit this quiz (uses the edit method found at GET /quizzes/{id}/edit -->
                            <a class="btn edit-btn" title="Edit quiz" href="{{ URL::to('quizzes/' . $value->quiz_id . '/edit') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>

                            <!-- delete the quiz (uses the destroy method DESTROY /quizzes/{id} -->
                            <!-- we will add this later since its a little more complicated than the other two buttons -->
                                {{ Form::open(array('url' => 'quizzes/' . $value->quiz_id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <div title="Delete quiz">
                                    {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                                </div>
                                <!-- {{ Form::submit('Delete this Quiz', array('class' => 'btn btn-warning')) }} -->
                             {{ Form::close() }}
                            

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </section>
    </main>


@endsection