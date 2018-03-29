@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="crud-page-top">
            <h1 class="crud-page-title">Input password</h1>
            <h5>Quiz: <?php echo $quiz->topic ?></h5>
        </section>
        <section>
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info" role="alert">
                    <strong>Heads up</strong>
                    {{ Session::get('message') }}
                </div>
            @endif

            {{ Form::open(array('url' =>'redirect_pw' )) }}
                <div class="form-group">
                    {{ Form::label('password', 'Password') }}
                    {{ Form::text('password', Request::old('password'), array('class' => 'form-control')) }}
                </div>

                {{ Form::hidden('quiz_id', $quiz->quiz_id) }}

                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('levels') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Enter', array('class' => 'btn btn-primary create-btn text-center')) }}
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