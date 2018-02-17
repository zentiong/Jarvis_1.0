<!-- @extends('templates.dashboard-master')  -->

@section('body')

	<main class="container create-page">
		<section class="row crud-page-top">
			<h1 class="crud-page-title">Edit Skill</h1>
		</section>
		<section>
			{{ Html::ul($errors->all()) }}

			{{ Form::model($skill, array('route' => array('skills.update', $skill->id), 'method' => 'PUT')) }}

			    <div class="form-group">
			        {{ Form::label('name', 'Name') }}
			        {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
			    </div>
				
				<div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('skills') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>

			{{ Form::close() }}

			</div>
		</section>
	</main>



@endsection 