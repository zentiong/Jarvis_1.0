@extends('templates.dashboard-master')

@section('body')
	<main class="container create-page">
		<section class="row crud-page-top">
			<h1 class="crud-page-title">Add Service</h1>
			<a href="{{ URL::to('positions') }}" class="btn cancel-btn">Back to All Services</a>
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

			{{ Form::open(array('url' => 'services')) }}
				<div class="form-group">
				    {{ Form::label('name', 'Service Name') }}
				    {{ Form::text('name', Request::old('name'), array('class' => 'form-control', 'autofocus')) }}
				</div>
			   	<div class="form-group text-center create-bottom-wrapper">
			   		<a href="{{ URL::to('positions') }}" class="btn cancel-btn">Cancel</a>
			   		 {{ Form::submit('Create position', array('class' => 'btn btn-primary create-btn text-center')) }}
			   	</div>

			{{ Form::close() }}
		</section>
	</main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('services');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>