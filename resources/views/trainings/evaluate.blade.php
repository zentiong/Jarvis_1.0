@extends('templates.dashboard-master')

@section('body')

<br>
<br>

    <main class="container-fluid">
        <section class="container-fluid">
            
            {{ Form::open(array('url' => 'store_evaluation')) }}

            {{ $user_training->training_id}}

            {{ Form::hidden('training_id', $value = $user_training->training_id) }}

            <div class="form-group">
                {{ Form::label('evaluation', 'Evaluation') }}
                {{ Form::text('evaluation', Request::old('evaluation'), array('class' => 'form-control', 'autofocus')) }}
            </div>

            {{ Form::submit('Provide Feedback', array('class' => 'btn btn-primary create-btn text-center')) }}
            {{ Form::close() }}

        </section>

    </main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('training-sessions');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>