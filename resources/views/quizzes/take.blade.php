@extends('templates.newsletter-master')

@section('body')

<!-- 

Take Quiz Implementation:

1) Each input should be assigned to answer_attempt() array
2) Answer Attempt ought to be compared to corresponding answer item
    -(test via popout)



-->



 <?php $var = 0; ?>

 <?php $answer_attempt = array(); ?>

<h2> Take quiz ({{ $quiz->topic }} ) </h2>
<h5> Number of Questions: {{ count($questions) }} </h5>

{{ Auth::user()->id}}

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

 <br>
 <br>

 {{ Form::open(array('url' => 'quizzes')) }}

<?php 
 $id = Auth::user()->id;

 /*
 $request->request->add(['user_id' => $id]);
*/

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

                    {{ Form::label('answer_attempt[$var]', 'Answer') }}
                    {{ Form::text('answer_attempt[$var]', Request::old('answer_attempt[$var]'), array('class' => 'form-control')) }}


                <?php 
                    $var ++;
                ?>
                <!-- Don't know shit about this yet -->
            </td>
        </tr>
    @endforeach
    </tbody>

                
    </table>


   {{ Form::submit('Submit Answers!', array('class' => 'btn btn-primary')) }}

   {{ Form::close() }}


</div>
@endsection