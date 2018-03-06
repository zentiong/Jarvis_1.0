@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('training-sessions');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>
<br>
<br>
<br>
@if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
@section('body')
    
    <h2> Recommend Trainings </h2>
    {{ Form::open(array('url' => 'recommend_fire')) }}

           
    <div class="form-group">
        {{ Form::label('training', 'Training') }}
        <select id="training" class="form-control" name="training">
            @foreach($trainings as $key => $training)
                <option value="<?php echo $training->id ?>">
                    {{$training->title}} 
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        
        @foreach($users as $key => $user)
            {{ Form::label($user->id, $user->first_name.' '.$user->last_name) }}
            {{ Form::checkbox($user->id,$user->id, true) }}
            <p> {{$user->id}} </p>
            <br>
        @endforeach

    </div>

     {{ Form::submit('Recommend', array('class' => 'btn btn-primary create-btn text-center')) }}

     {{ Form::close() }}
@endsection