@extends('templates.dashboard-master')


@section('body')

	<main class="container create-page">
		<section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">Edit Question Item</h1>
                <h5>{{ $question->question_item }}</h5>
            </div>
			<a href="{{ url()->previous() }}" class="btn cancel-btn">Back to Questions</a>
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

			{{ Form::model($question, array('route' => array('quizzes.questions.update', $quiz->quiz_id, $question->id ), 'method' => 'PUT')) }}


		   <!--  <div class="form-group">
		        {{ Form::label('question_item', 'Question') }}
		        {{ Form::text('question_item', Request::old('question_item'), array('class' => 'form-control')) }}
		    </div>
		    <div class="form-group">
		        {{ Form::label('answer_item', 'Answer') }}
		        {{ Form::text('answer_item', Request::old('answer_item'), array('class' => 'form-control')) }}
		    </div> -->

		    <input type="hidden" name="section_id" id="bookId" value=""/>
            <div class="form-group">
            	{{ Form::label('question_item', 'Question') }}
            	{{ Form::text('question_item', Request::old('question_item'), array('class' => 'form-control', 'required')) }}
             </div>
             <div class="form-group">
                 {{ Form::label('answer_item', 'Answer') }}
                 {{ Form::select('answer_item', [
                   'choice_1' => '1st Choice',
                   'choice_2' => '2nd Choice',
                   'choice_3' => '3rd Choice',
                   'choice_4' => '4th Choice']
                ) }}
            </div>
            <div class="form-group">
                {{ Form::label('choice_1', '1st Choice') }}
                {{ Form::text('choice_1', Request::old('choice_1'), array('class' => 'form-control', 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('choice_2', '2nd Choice') }}
                {{ Form::text('choice_2', Request::old('choice_2'), array('class' => 'form-control', 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('choice_3', '3rd Choice') }}
                {{ Form::text('choice_3', Request::old('choice_3'), array('class' => 'form-control', 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('choice_4', '4th Choice') }}
                {{ Form::text('choice_4', Request::old('choice_4'), array('class' => 'form-control', 'required')) }}
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