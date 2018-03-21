@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <h1 class="crud-page-title">Add question</h1>
        </section>
        <section>
            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            <?php 
                $quiz_id = Request::get('quiz_id');
                $section_id = Request::get('section_id');
            ?>

            {{ Form::open(array('url' => 'quizzes/'.$quiz_id.'/questions')) }}

                {{ Form::hidden('quiz_id', $quiz_id) }}
                {{ Form::hidden('section_id', $section_id) }}
                <div id="div1">
                    <div class="form-group">
                        {{ Form::label('question_item', 'Question') }}
                        {{ Form::text('question_item', Request::old('question_item'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('answer_item', 'Answer') }}
                        {{ Form::text('answer_item', Request::old('answer_item'), array('class' => 'form-control')) }}
                    </div>

                    <!-- <div class="form-group text-center create-bottom-wrapper">
                        <a href="{{ URL::to('users') }}" class="btn cancel-btn">Cancel</a>
                         {{ Form::submit('Create employee', array('class' => 'btn btn-primary create-btn text-center')) }}
                    </div>     -->

                </div>

                <br>
                {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
                
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
</script>