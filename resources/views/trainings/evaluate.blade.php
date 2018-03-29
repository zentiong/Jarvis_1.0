@extends('templates.dashboard-master')

@section('body')
    {{ Form::open(array('url' => 'store_evaluation')) }}

    {{ $user_training->training_id}}

    {{ Form::hidden('training_id', $value = $user_training->training_id) }}
    <main class="container create-page">
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <section class="crud-page-top">
            <h1 class="crud-page-title">Evaluate Training: {{ $training_title}}</h1>
        </section>
        <section>
            
            <div class="form-group">
                {{ Form::label('rating_training', 'How did you find the training?') }}
                {{ Form::radio('rating_training', '1' ) }}
                {{ Form::radio('rating_training', '2' ) }}
                {{ Form::radio('rating_training', '3' ) }}
                {{ Form::radio('rating_training', '4' ) }}
                {{ Form::radio('rating_training', '5' ) }}

            </div>
            <div class="form-group">
                {{ Form::label('rating_speaker', 'How did you find the speaker?') }}
                {{ Form::radio('rating_speaker', '1' ) }}
                {{ Form::radio('rating_speaker', '2' ) }}
                {{ Form::radio('rating_speaker', '3' ) }}
                {{ Form::radio('rating_speaker', '4' ) }}
                {{ Form::radio('rating_speaker', '5' ) }}

            </div>
            <div class="form-group">
                {{ Form::label('evaluation', 'Any comments or suggestions?') }}
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