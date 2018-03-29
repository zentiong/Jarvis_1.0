@extends('templates.dashboard-master')

@section('body')
	<main class="container create-page">
		<section class="row crud-page-top">
			<h1 class="crud-page-title">Edit {{ $assessment->criteria }}</h1>
			<a href="{{ url()->previous() }}" class="btn cancel-btn">Go Back</a>
		</section>
		<section>
			<!-- if there are creation errors, they will show here -->
            @if (Session::has('errors'))
                <div class="alert alert-warning" role="alert">
                    <strong>Warning</strong>
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif

			{{ Form::model($assessment, array('route' => array('assessments.assessment_items.update', $assessment->id, $assessment_item->id ), 'method' => 'PUT')) }}

			    <div class="form-group">
			        {{ Form::label('criteria', 'Criteria') }}
			        {{ Form::text('criteria', Request::old('criteria'), array('class' => 'form-control', 'autofocus')) }}
			    </div>
				
				<div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('assessments/'.$assessment->id.'/assessment_items') }}" class="btn cancel-btn">Cancel</a>
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