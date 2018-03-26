@extends('templates.dashboard-master')
            
@section('body')
     <main class="container create-page">
        <section class="row crud-page-top">
            <h1 class="crud-page-title">Recommend Trainings</h1>
            <p><strong>STEP 1: Choose a training</strong></p>
        </section>
        <section>
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            
            {{ Form::open(array('url' => 'recommend_who')) }}
            

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
            <div class="form-group text-center create-bottom-wrapper">
                <a href="{{ URL::to('levels') }}" class="btn cancel-btn">Cancel</a>
                {{ Form::submit('Proceed to next step', array('class' => 'btn btn-primary create-btn text-center')) }}
            </div>
            {{ Form::close() }}
        </section>
    </main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('levels');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>