@extends('templates.dashboard-master')

@section('body')
    {{ Form::open(array('url' => 'store_evaluation')) }}

    {{ $user_training->training_id}}

    {{ Form::hidden('training_id', $value = $user_training->training_id) }}
    <main class="container create-page">
        <section class="crud-page-top">
            <h1 class="crud-page-title">Evaluate Training</h1>
        </section>
        <section>
            <div class="form-group">
                {{ Form::label('evaluation', 'Evaluation') }}
                {{ Form::text('evaluation', Request::old('evaluation'), array('class' => 'form-control', 'autofocus')) }}
            </div>
            <div class="form-group text-center create-bottom-wrapper">
                <a href="{{ URL::to('levels') }}" class="btn cancel-btn">Cancel</a>
                {{ Form::submit('Submit Feedback', array('class' => 'btn btn-primary create-btn text-center')) }}
            </div>
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
</script>