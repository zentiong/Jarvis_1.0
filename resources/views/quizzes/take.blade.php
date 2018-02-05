@extends('templates.newsletter-master')

@section('body')

<!-- 

Take Quiz Implementation:

1) Each input should be assigned to answer_attempt() array
2) Answer Attempt ought to be compared to corresponding answer item
    -(test via popout)



-->



 

<h2> Take quiz ({{ $quiz->topic }}) </h2>

<!--
<h5> Number of Questions: {{ count($questions) }} </h5>

{{ Auth::user()->id}}
-->

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

 <br>
 <br>

    

 <!-- {{ Form::open(array('url' => 'quizzes/'.$quiz->quiz_id.'/record')) }} -->

    {{ Form::open(array('url' => 'quizzes/'.$quiz->quiz_id.'/record')) }}

    {{ Form::hidden('user_id', $value = Auth::user()->id) }}
    {{ Form::hidden('quiz_id', $value = $quiz->quiz_id) }}

    <?php 

        $var = 0; 
 
    ?>
    
 
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Question</td>
        </tr>
    </thead>

    <tbody>

   
    @foreach($questions as $key => $value)

        <?php 

        ?>

        <tr>
            <td>{{ $value->question_item }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <!-- Don't know shit about this yet 
                 
                -->

                

                <!-- 
                    Assign the value being inputted to answer_attempt
                -->

                {{ Form::label('answer_attempt[]', 'Answer') }}
                {{ Form::text('answer_attempt[]', Request::old('DEFAULT AA'), array('class' => 'form-control')) }}


                <?php 
                    $var ++;
                ?>
                <!-- Don't know shit about this yet -->
                <!--
                <input type="text" name="item[]">
                -->
                
                
            </td>
        </tr>
    @endforeach
    </tbody>

                
    </table>

    


   {{ Form::submit('Submit Answers!', array('class' => 'btn btn-primary')) }}

   {{ Form::close() }}
@endsection