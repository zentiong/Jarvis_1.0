@extends('templates.dashboard-master')

@section('body')

 <br>
 <br> <br>
 <br>
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif



    <h2>Input Password for Quiz: <?php echo $quiz->topic ?></h2>

    {{ Form::open(array('url' =>'redirect_pw' )) }}
        <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::text('password', Request::old('password'), array('class' => 'form-control')) }}
        </div>

        {{ Form::hidden('quiz_id', $quiz->quiz_id) }}
            
        <a href="{{ URL::to('levels') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
        {{ Form::submit('Submit', array('class' => 'btn btn-primary create-btn text-center')) }}

    {{ Form::close() }}

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