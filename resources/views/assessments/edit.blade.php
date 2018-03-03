@extends('templates.dashboard-master')
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

@section('body')

	<main class="container create-page">
		<section class="row crud-page-top">
            <h1 class="crud-page-title">Edit {{ $assessment->topic }}</h1>
        </section>
        <section>
        	<!-- if there are creation errors, they will show here -->
			{{ Html::ul($errors->all()) }}

			{{ Form::model($assessment, array('route' => array('assessments.update', $assessment->assessment_id), 'method' => 'PUT')) }}

                <?php /*

			    <div class="form-group">
			        {{ Form::label('topic', 'Topic') }}
			        {{ Form::text('topic', Request::old('topic'), array('class' => 'form-control', 'autofocus')) }}
			    </div>

                */ ?>

			    <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('assessments') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>

			{{ Form::close() }}
        </section>
	</main>

@endsection