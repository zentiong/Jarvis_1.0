@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <h1 class="crud-page-title">Create Assessment</h1>
            <a href="{{ URL::to('assessments') }}" class="btn cancel-btn">Back to All Assessments</a>
        </section>
        <hr>
        <section>
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info" role="alert">
                    <strong>Heads up</strong>
                    {{ Session::get('message') }}
                </div>
            @endif

            <!-- if there are creation errors, they will show here -->
            @if (Session::has('errors'))
                <div class="alert alert-warning" role="alert">
                    <strong>Warning</strong>
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif

            {{ Form::open(array('url' => 'assessments')) }}

                <?php /*
                <div class="form-group">
                    {{ Form::label('topic', 'Topic') }}
                    {{ Form::text('topic', Request::old('topic'), array('class' => 'form-control', 'autofocus')) }}
                </div>

                */ ?>

                <div class="form-group">
                    {{ Form::label('skill_id', 'Relevant skill') }}
                    <select id="skill" class="form-control" name="skill">
                        @foreach($skills as $key => $value)
                            <option value="<?php echo $value->id ?>">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('assessments') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Create assessment', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>

            {{ Form::close() }}
        </section>
    </main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('assessments');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>


