@extends('templates.dashboard-master')

@section('body')

	<main class="container create-page">
		<section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">Edit HR</h1>
                <h5>{{ $hr->name }}</h5>
            </div>
            <a href="{{ URL::to('hrs') }}" class="btn cancel-btn">Back to All HR</a>
        </section>
        <hr>
        <section>
        	<!-- if there are creation errors, they will show here -->
            @if (Session::has('errors'))
                <div class="alert alert-warning" role="alert">
                    <strong>Warning</strong>
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif

		{{ Form::model($hr, 
            array('route' => array('hrs.update', $hr->id), 'method' => 'PUT', 'files' => true)) }}

                <div class="form-group">
                    {{Form::label('hr_photo', 'Photo',['class' => 'control-label'])}}
                    <div class="form-control user-photo">{{Form::file('hr_photo')}} 
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', Request::old('name'), array('class' => 'form-control', 'autofocus', 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('position', 'Position') }}
                    {{ Form::text('position', Request::old('position'), array('class' => 'form-control', 'autofocus', 'required' )) }}
                </div>


              </div>

                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('services') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>  

                <!-- {{ Form::submit('Edit service', array('class' => 'btn btn-primary')) }} -->

            {{ Form::close() }}
        </section>
	</main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('Services');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>