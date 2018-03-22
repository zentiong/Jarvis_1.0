@extends('templates.dashboard-master')

@section('body')

	<main class="container create-page">
		<section class="row crud-page-top">
            <h1 class="crud-page-title">Edit Position</h1>
        </section>
        <section>
        	{{ Html::ul($errors->all()) }}

			{{ Form::model($position, 
			array('route' => array('positions.update', $position->id), 'method' => 'PUT')) }}

				
			    <div class="form-group">
			        {{ Form::label('name', 'Position Name') }}
			        {{ Form::text('name', Request::old('name'), array('class' => 'form-control', 'autofocus')) }}
			    </div>

			    <div class="form-group">
                    {{ Form::label('job_grade', 'Job Grade') }}
                    <select id="job_grade" class="form-control" name="job_grade">
                      @foreach($job_grades as $key => $job_grade)
                        <option value="<?php echo $job_grade->id ?>">{{$job_grade->id}} 
                        @if($job_grade->id<(10))
                            &nbsp;
                        @endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Knowledge: {{$job_grade->knowledge_based_weight}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Skills: {{$job_grade->skills_based_weight}}</option>
                      @endforeach
                    </select>
                </div>

				<div class="form-group text-center create-bottom-wrapper">
					<a href="{{ URL::to('positions') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
				</div>  

			    <!-- {{ Form::submit('Edit Position', array('class' => 'btn btn-primary')) }} -->

			{{ Form::close() }}
        </section>
	</main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('positions');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>