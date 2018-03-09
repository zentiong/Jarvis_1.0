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
    <main class="container-fluid">
        <section class="container-fluid">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">All Quizzes</h1>
               <button class="btn crud-main-cta" type="button" data-toggle="modal" data-target="#createModal">&#43; Add Quiz</button>
            </div>

            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            {{ Html::ul($errors->all()) }}

            <?php 
            $user_id = Auth::user()->id;
            $taken = false;
            ?>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Quiz ID</td>
                        <td>Topic</td>
                        <td>Training</td>
                        <td class="no-stretch">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($quizzes as $key => $value)
                    <tr>
                        

                        <td>{{ $value->quiz_id }}</td>
                        <td>{{ $value->topic }}</td>
                        <td>
                        @foreach($trainings as $key => $training)
                            @if($value->training_id == $training->id)
                                {{$training->title}}
                            @endif
                        @endforeach
                         </td>

                        <!-- we will also add show, edit, and delete buttons -->
                        <td class="table-actions no-stretch">

                            <!-- show the quiz (uses the show method found at GET /quizzes/{id} -->
                            <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View quiz" href="{{ URL::to('quizzes/' . $value->quiz_id . '/questions') }}">
                                <i class="fa fa-user fa-lg"></i>
                            </a>

                            <!-- edit this quiz (uses the edit method found at GET /quizzes/{id}/edit -->
                            <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit quiz" href="{{ URL::to('quizzes/' . $value->quiz_id . '/edit') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>

                            <!-- delete the quiz (uses the destroy method DESTROY /quizzes/{id} -->
                            <!-- we will add this later since its a little more complicated than the other two buttons -->
                                {{ Form::open(array('url' => 'quizzes/' . $value->quiz_id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <div data-toggle="tooltip" data-placement="bottom" title="Delete quiz">
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

        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                 {{ Form::open(array('url' => 'quizzes')) }}

                  <div class="form-group">
                      {{ Form::label('topic', 'Topic') }}
                      {{ Form::text('topic', Request::old('topic'), array('class' => 'form-control')) }}
                  </div>

                  <div class="form-group">
                      {{ Form::label('password', 'Password') }}
                      {{ Form::text('password', Request::old('password'), array('class' => 'form-control')) }}
                  </div>


                    {{ Form::label('training', 'Training') }}
                    <select id="training_id" class="form-control" name="training_id">
                        @foreach($trainings as $key => $training)
                        <?php
                            $taken = false;
                        ?>
                        <!-- Implement 1 quiz is to 1 training -->
                            @foreach($quizzes as $key => $quiz)
                                @if($quiz->training_id == $training->id)
                                    <?php 
                                        $taken = true;
                                    ?>
                                @endif
                            @endforeach
                            @if(!$taken)
                                <option value="<?php echo $training->id ?>">{{$training->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
              <div class="modal-footer create-bottom-wrapper">
                <a href="{{ URL::to('quizzes') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
                {{ Form::submit('Create quiz', array('class' => 'btn btn-primary create-btn text-center')) }}
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>


    </main>


@endsection