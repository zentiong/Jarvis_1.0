@extends('templates.dashboard-master')

@section('body')

<main class="container create-page">
	<section class="row crud-page-top">
        <h1 class="crud-page-title">Add New Skill</h1>
    </section>
    <section>
    	<!-- if there are creation errors, they will show here -->
		{{ Html::ul($errors->all()) }}

		{{ Form::open(array('url' => 'skills')) }}

		    <div class="form-group"> 
		        {{ Form::label('name', 'Name') }}
		        {{ Form::text('name', Request::old('name'), array('class' => 'form-control', 'autofocus')) }}
		    </div>
		    <div class="form-group"> 
		        {{ Form::label('description', 'Description') }}
		        {{ Form::text('description', Request::old('description'), array('class' => 'form-control', 'autofocus')) }}
		    </div>
			
			<div class="form-group text-center create-bottom-wrapper">
				<a href="{{ URL::to('skills') }}" class="btn cancel-btn">Cancel</a>
				{{ Form::submit('Create skill', array('class' => 'btn btn-primary create-btn text-center')) }}
			</div>
		    

		{{ Form::close() }}

		</div>
    </section>
</main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('skills');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>


