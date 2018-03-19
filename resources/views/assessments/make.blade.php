@extends('templates.dashboard-master')


@section('body')

<br>
<br>
<br>

<h2> Make a {{ $assessment->topic }} Assessment  </h2>

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
    {{ Html::ul($errors->all()) }}

    {{ Form::open(array('url' => 'assessments/'.$assessment->id.'/record')) }}

    {{ Form::hidden('supervisor_id', $value = Auth::user()->id) }}
    {{ Form::hidden('assessment_id', $value = $assessment->id) }}


    <div class="form-group">
        {{ Form::label('user', 'Employee') }}
  
        <select id="user" class="form-control" name="user">
        @foreach($users as $key => $value)
            <option value="<?php echo $value->id ?>">
                {{$value->first_name}} {{$value->last_name}}
            </option>
        @endforeach
        </select>

    </div>

    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Question</td>
        </tr>
    </thead> 
    <tbody>

        <?php 
            $i = 0
        ?>
   
    @foreach($assessment_items as $key => $value)

        <tr>
            <td>{{ $value->criteria }}</td>
            <td>

                {{ Form::radio('grades['.$i.']', '1' ) }}
                {{ Form::radio('grades['.$i.']', '2' ) }}
                {{ Form::radio('grades['.$i.']', '3' ) }}
                {{ Form::radio('grades['.$i.']', '4' ) }}
                {{ Form::radio('grades['.$i.']', '5' ) }}

                <?php
                   $i++;
                ?>
                
            </td>

        </tr>

    @endforeach
    </tbody>

     {{ Form::hidden('ideal_count', $value = $i) }}
   
    </table>

    <?php
        $i;
    ?>


    
    {{ Form::label('feedback', 'Feedback') }}
    {{ Form::text('feedback', Request::old('feedback'), array('class' => 'form-control')) }}


   {{ Form::submit('Submit Ratings!', array('class' => 'btn btn-primary')) }}

   {{ Form::close() }}
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>