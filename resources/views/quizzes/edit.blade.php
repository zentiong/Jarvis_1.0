@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <h1 class="crud-page-title">Edit {{ $quiz->topic }}</h1>
        </section>
        <section>
            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}


            {{ Form::model($quiz, array('route' => array('quizzes.update', $quiz->quiz_id), 'method' => 'PUT')) }}

                <div class="form-group">
                    {{ Form::label('topic', 'Topic') }}
                    {{ Form::text('topic', Request::old('topic'), array('class' => 'form-control')) }}
                </div>

                <select id="skill" class="form-control" name="skill">
                   @foreach($skills as $key => $value)
                        <option value="<?php echo $value->id ?>">{{$value->name}}</option>
                   @endforeach
                  </select>
                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('quizzes') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>

            {{ Form::close() }}
        </section>
    </main>



@endsection