@extends('templates.dashboard-master')

@section('body')
  <main class="container create-page">
      <section class="row crud-page-top">
          <h1 class="crud-page-title">Add Quiz</h1>
      </section>
      <section>
          <!-- if there are creation errors, they will show here -->
          {{ Html::ul($errors->all()) }}

          {{ Form::open(array('url' => 'quizzes')) }}

              <div class="form-group">
                  {{ Form::label('topic', 'Topic') }}
                  {{ Form::text('topic', Request::old('topic'), array('class' => 'form-control')) }}
              </div>

              <!-- 
                  Skill Related

                  {{ Form::label('skill', 'Skill') }}
               <select id="skill" class="form-control" name="skill">
               <?php
               /*
                 @foreach($skills as $key => $value)
                      <option value="<?php echo $value->id ?>">{{$value->name}}</option>
                 @endforeach
                 */
                 ?>
                </select>
              -->
              <div class="form-group text-center create-bottom-wrapper">
                  <a href="{{ URL::to('quizzes') }}" class="btn cancel-btn">Cancel</a>
                  {{ Form::submit('Create quiz', array('class' => 'btn btn-primary create-btn text center')) }}
              </div>

          {{ Form::close() }}
        
      </section>
  </main>



@endsection


