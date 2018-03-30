@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="crud-page-top">
            <h1 class="crud-page-title">Currently taking quiz</h1>
            <h5>{{ $quiz->topic }}</h5>
        </section>
        <hr>
        <section>
            <!-- 

            Take Quiz Implementation:

            1) Each input should be assigned to answer_attempt() array
            2) Answer Attempt ought to be compared to corresponding answer item
                -(test via popout)

            <h5> Number of Questions: {{ count($questions) }} </h5>

            {{ Auth::user()->id}}
            -->

            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info" role="alert">
                    <strong>Heads up</strong>
                    {{ Session::get('message') }}
                </div>
            @endif


             <!-- {{ Form::open(array('url' => 'quizzes/'.$quiz->quiz_id.'/record')) }} -->

                {{ Form::open(array('url' => 'quizzes/'.$quiz->quiz_id.'/record')) }}

                {{ Form::hidden('quiz_id', $value = $quiz->quiz_id) }}

                <?php
                    $var = 0; 
                ?>   
                
                <hr>

                @foreach($questions as $key => $value)
                <div class="take-quiz-wrapper">
                    <h6><strong>{{$var+1}}. {{ $value->question_item }}</strong></h6>
                    <div class="row answer-items" data-toggle="buttons">
                        <div class="col-md">
                            <div class="answer-item-row btn">
                                {{ Form::radio( 'answer_attempt['.$var.']', $value->choice_1 ) }}
                                a. {{ Form::label('choice_1', $value->choice_1) }}
                            </div>
                            <div class="answer-item-row btn">
                                {{ Form::radio('answer_attempt['.$var.']',  $value->choice_2 ) }}
                                b. {{ Form::label('choice_1', $value->choice_2) }}
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="answer-item-row btn">
                                {{ Form::radio('answer_attempt['.$var.']',  $value->choice_3 ) }}
                                c. {{ Form::label('choice_1', $value->choice_3) }}
                            </div>
                            <div class="answer-item-row btn">
                                {{ Form::radio('answer_attempt['.$var.']',  $value->choice_4 ) }}
                                d. {{ Form::label('choice_1', $value->choice_4) }} 
                            </div>
                        </div>
                        <?php 
                            $var ++;
                        ?>
                    </div>
                </div>
                @endforeach

                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('levels') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Submit answers', array('class' => 'btn btn-primary create-btn text-center')) }}
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

        // var $radios = $('input:radio');
        // $radios.change(function () {
        //   $radios.parent().removeClass('checked');
        //   $(this).parent().addClass('checked');
        // });
    });
    
</script>