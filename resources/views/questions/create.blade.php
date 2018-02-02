@extends('templates.newsletter-master')

@section('body')

<h1>Add Questions</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'quizzes/'.$quiz_id.'/questions')) }}
    <div id="div1">
        <div class="form-group">
            {{ Form::label('question_item', 'Question') }}
            {{ Form::text('question_item', Request::old('question_item'), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('answer_item', 'Answer') }}
            {{ Form::text('answer_item', Request::old('answer_item'), array('class' => 'form-control')) }}
        </div>
        <button id="add-btn">Add</button>
    </div>

    <script type="text/javascript">
            function copy_qs(){
                var orig_div_content = document.getElementById('div1');
                var new_div_content = document.getElementById('div2');
                new_div_content.innerHTML = orig_div_content.innerHTML;
            }

            if (document.getElementById('add-btn').click==true) {
               alert("button click")
            };
            
        </script>

    <br>
    {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    
{{ Form::close() }}

</div>
@endsection