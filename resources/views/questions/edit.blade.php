@extends('templates.dashboard-master')


@section('body')

	<main class="container create-page">
		<section class="crud-page-top">
			<h1 class="crud-page-title">Edit Question Item</h1>
			<h5>{{ $question->question_item }}</h5>
		</section>
		<section>
			<!-- if there are creation errors, they will show here -->
			{{ Html::ul($errors->all()) }}

			{{ Form::model($question, array('route' => array('quizzes.questions.update', $quiz->quiz_id, $question->id ), 'method' => 'PUT')) }}


		    <div class="form-group">
		        {{ Form::label('question_item', 'Question') }}
		        {{ Form::text('question_item', Request::old('question_item'), array('class' => 'form-control')) }}
		    </div>
		    <div class="form-group">
		        {{ Form::label('answer_item', 'Answer') }}
		        {{ Form::text('answer_item', Request::old('answer_item'), array('class' => 'form-control')) }}
		    </div>

		    <div class="form-group text-center create-bottom-wrapper">
            	<a href="{{ URL::to('quizzes') }}" class="btn cancel-btn">Cancel</a>
             	{{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
            </div>

			{{ Form::close() }}
		</section>
	</main>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>