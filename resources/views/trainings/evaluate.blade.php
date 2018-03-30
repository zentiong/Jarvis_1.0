@extends('templates.dashboard-master')

@section('body')
    {{ Form::open(array('url' => 'store_evaluation')) }}

    {{ $user_training->training_id}}

    {{ Form::hidden('training_id', $value = $user_training->training_id) }}
    <main class="container create-page">
        <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info" role="alert">
                    <strong>Heads up</strong>
                    {{ Session::get('message') }}
                </div>
            @endif
        <section class="crud-page-top">
            <h1 class="crud-page-title">Evaluate Training</h1>
            <h5>{{ $training_title}}</h5>
        </section>
        <hr>
        <section class="evaluate-training-wrapper">
            <div class="form-group">
                <h6><strong>How would you rate the training?</strong></h6>
                <caption>(1 = really bad, 5 = really good)</caption>
                <div data-toggle="buttons">
                    <div class="evaluate-item-row btn">
                        {{ Form::radio('rating_training', '1' ) }}
                        {{ Form::label('rating_training', '1') }}
                    </div>
                    <div class="evaluate-item-row btn">
                        {{ Form::radio('rating_training', '2' ) }}
                        {{ Form::label('rating_training', '2') }}
                    </div>
                    <div class="evaluate-item-row btn">
                        {{ Form::radio('rating_training', '3' ) }}
                        {{ Form::label('rating_training', '3') }}
                    </div>
                    <div class="evaluate-item-row btn">
                        {{ Form::radio('rating_training', '4' ) }}
                        {{ Form::label('rating_training', '4') }}
                    </div>
                    <div class="evaluate-item-row btn">
                        {{ Form::radio('rating_training', '5' ) }}
                        {{ Form::label('rating_training', '5') }}
                    </div>
                </div>
            </div>

            <div class="form-group" data-toggle="buttons">
                <h6><strong>How would you rate the speaker?</strong></h6>
                <caption>(1 = really bad, 5 = really good)</caption>
                <!-- {{ Form::label('rating_speaker', 'How did you find the speaker?') }} -->
                <div data-toggle="buttons">
                    <div class="evaluate-item-row btn">
                        {{ Form::radio('rating_speaker', '1' ) }}
                        {{ Form::label('rating_speaker', '1') }}
                    </div>
                    <div class="evaluate-item-row btn">
                        {{ Form::radio('rating_speaker', '2' ) }}
                        {{ Form::label('rating_speaker', '2') }}
                    </div>
                    <div class="evaluate-item-row btn">
                        {{ Form::radio('rating_speaker', '3' ) }}
                        {{ Form::label('rating_speaker', '3') }}
                    </div>
                    <div class="evaluate-item-row btn">
                        {{ Form::radio('rating_speaker', '4' ) }}
                        {{ Form::label('rating_speaker', '4') }}
                    </div>
                    <div class="evaluate-item-row btn">
                        {{ Form::radio('rating_speaker', '5' ) }}
                        {{ Form::label('rating_speaker', '5') }}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <h6><strong>{{ Form::label('evaluation', 'Any comments or suggestions?') }}</strong></h6>
                {{ Form::text('evaluation', Request::old('evaluation'), array('class' => 'form-control', 'autofocus')) }}
            </div>
            <div class="form-group text-center create-bottom-wrapper">
                <a href="{{ URL::to('levels') }}" class="btn cancel-btn">Cancel</a>
                {{ Form::submit('Submit feedback', array('class' => 'btn btn-primary create-btn text-center')) }}
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