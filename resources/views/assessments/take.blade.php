@extends('templates.newsletter-master')

@section('body')

<!-- 

Take Quiz Implementation:

1) Each input should be assigned to answer_attempt() array
2) Answer Attempt ought to be compared to corresponding answer item
    -(test via popout)



-->

<h2> Make an Assessment ({{ $assessment->topic }}) </h2>
<p> Ideally lahat ng under the supervisor (all users with supervisor Id of user (boss) (FOR LATER)</p>
<!--
<h5> Number of Questions: {{ count($assessment_items) }} </h5>

{{ Auth::user()->id}}
-->

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

 <br>
 <br>

    {{ Form::open(array('url' => 'assessments/'.$assessment->id.'/record')) }}

    {{ Form::hidden('supervisor_id', $value = Auth::user()->id) }}
    {{ Form::hidden('assessment_id', $value = $assessment->id) }}


    {{ Form::label('employee_id', 'Employee') }}
    {{ Form::text('employee_id', Request::old('DEFAULT AA'), array('class' => 'form-control')) }}


    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Question</td>
        </tr>
    </thead>

    <tbody>


   
    @foreach($assessment_items as $key => $value)

        <?php 

        ?>

        <tr>
            <td>{{ $value->criteria }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <!-- Don't know shit about this yet 
                 
                -->

                

                <!-- 
                    Assign the value being inputted to answer_attempt
                -->

                {{ Form::label('grades[]', 'Grade') }}
                {{ Form::text('grades[]', Request::old('DEFAULT AA'), array('class' => 'form-control')) }}

                <!-- Don't know shit about this yet -->
                <!--
                <input type="text" name="item[]">
                -->
                
                
            </td>
        </tr>
    @endforeach
    </tbody>

                
    </table>

    
    {{ Form::label('feedback', 'Feedback') }}
    {{ Form::text('feedback', Request::old('feedback'), array('class' => 'form-control')) }}


   {{ Form::submit('Submit Ratings!', array('class' => 'btn btn-primary')) }}

   {{ Form::close() }}
@endsection