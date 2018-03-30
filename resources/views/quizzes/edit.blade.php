@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">Edit quiz</h1>
                <h5>Quiz Topic: {{ $quiz->topic }}</h5>
            </div>
            <a href="{{ URL::to('quizzes') }}" class="btn cancel-btn">Back to All Quizzes</a>
        </section>
        <hr>
        <section>
            <!-- if there are creation errors, they will show here -->
            @if (Session::has('errors'))
                <div class="alert alert-warning" role="alert">
                    <strong>Warning</strong>
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif

            {{ Form::model($quiz, array('route' => array('quizzes.update', $quiz->quiz_id), 'method' => 'PUT')) }}
                
                <div class="form-group">
                    {{ Form::label('topic', 'Topic') }}
                    {{ Form::text('topic', Request::old('topic'), array('class' => 'form-control', 'required')) }}
                </div>

                {{ Form::label('training', 'Training') }}
                    <select id="training_id" class="form-control" name="training_id">
                      @foreach($trainings as $key => $value)
                        @if($value->id == $quiz->training_id)
                             <option selected="selected" value="<?php echo $value->id ?>">{{$value->title}}</option>
                        @else
                             <option value="<?php echo $value->id ?>">{{$value->title}}</option>
                        @endif
            
                      @endforeach
                    </select>
                    
                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('quizzes') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>

            {{ Form::close() }}
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