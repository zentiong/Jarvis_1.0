@extends('templates.dashboard-master')

@section('body')
<br>
<br>
	<main class="container create-page">
		<section class="row crud-page-to">
			<h1 class="crud-page-title">Add Assessment Item</h1>
			<a href="{{ ur()->previous() }}" class="btn cancel-btn">Go Back</a>
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

			{{ Form::open(array('url' => 'assessments/'.$id.'/assessment_items')) }}
			    <div class="form-group" >
			        {{ Form::label('criteria', 'Criteria') }}
			        {{ Form::text('criteria', Request::old('criteria'), array('class' => 'form-control', 'autofocus', 'pattern' => '[a-zA-z ]+', 'required', 'title' => 'Please use alphabet characters only')) }}
			    </div>
			    <hr id="a-hr">	

			  	<div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('assessments/'.$id.'/assessment_items') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
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