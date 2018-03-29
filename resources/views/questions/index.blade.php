@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">Questions</h1> 
                <h5>Quiz Topic: {{ $quiz->topic }}</h5>
            </div>
            <a href="{{ URL::to('quizzes') }}" class="btn cancel-btn">Back to All Quizzes</a>
        </section>
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <hr>
        <section>
            

             <!-- 
             <a href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/questions/create') }}" style="float: right;">Add a Question</a>
             -->
            <a href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/add_section') }}" class="btn crud-main-cta">&#43; Add section</a>
            <br>
                <?php 
                $quiz_id = $quiz->quiz_id;
                
                 ?>
                <?php /*
                <h2>START TEST</h2>

                 @foreach($questions as $key => $value)
                     <tr>
                            <td>{{ $value->section_id }}</td>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->question_item }}</td>
                            <td>{{ $value->answer_item }}</td>
                    </tr>
                 @endforeach

                <h2>END TEST</h2>
                */ ?>

                <!--
                    If skill is already there, no section
                -->

                 @foreach($sections as $key => $section)
                    @foreach($skills as $key => $skill)
                        @if($skill->id == $section->skill_id)
                            <h6><b>Skill: {{$skill->name}}</b></h6>
                        @endif
                    @endforeach



                    <table class="table table-striped table-bordered">
                    
                    <thead>
                        <tr>
                            <td>Question</td>
                            <td>Answer </td>
                            <td>Choice 1 </td>
                            <td>Choice 2 </td>
                            <td>Choice 3 </td>
                            <td>Choice 4 </td>
                            <td class="no-stretch">Actions</td>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($questions as $key => $value)
                        
                        @if($value->section_id == $section->id)
                        <tr>
                            <td>{{ $value->question_item }}</td>
                            <td>{{ $value->answer_item }}</td>
                            <td>{{ $value->choice_1 }}</td>
                            <td>{{ $value->choice_2 }}</td>
                            <td>{{ $value->choice_3 }}</td>
                            <td>{{ $value->choice_4 }}</td>

                            <!-- we will also add show, edit, and delete buttons -->
                            <td class="table-actions">
                                <!-- show the quiz (uses the show method found at GET /quizzes/{id} -->
                                <!-- -->
                                <!-- <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View question" href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/questions/'.$value->id) }}">
                                    <i class="fa fa-user fa-lg"></i>
                                </a> -->

                                <!-- edit this quiz (uses the edit method found at GET /quizzes/{id}/edit -->
                                <!-- -->
                                <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit question item" href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/questions/'.$value->id.'/edit') }}">
                                    <i class="fa fa-pencil fa-lg"></i>
                                </a>

                                <!-- delete the quiz (uses the destroy method DESTROY /quizzes/{id} -->
                                <!-- we will add this later since its a little more complicated than the other two buttons -->
                                {{ Form::open(array('url' => 'quizzes/'.$quiz->quiz_id.'/questions/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    
                                    <div data-toggle="tooltip" data-placement="bottom" title="Remove question item">
                                        {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'Remove', 'class' => 'btn delete-btn')) }}
                                    </div>
                                 {{ Form::close() }}
                                
                            </td>
                        </tr>

                        @endif

                    @endforeach
                    </tbody>
                    </table>
                    <div class="text-right">
                        <button class="open-AddBookDialog btn question-btn" data-id="{{$section->id}}" type="button" data-toggle="modal" data-target="#createModal">&#43; Add question for this section</button>
                    </div>
                    
                     <!-- Modal -->
                     
                    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                {{ Form::open(array('url' => 'quizzes/'.$quiz_id.'/questions')) }}
                                
                                {{ Form::hidden('quiz_id', $quiz->quiz_id) }}
                                <input type="hidden" name="section_id" id="bookId" value=""/>
                                <div class="form-group">
                                    {{ Form::label('question_item', 'Question') }}
                                    {{ Form::text('question_item', Request::old('question_item'), array('class' => 'form-control')) }}
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
                                    {{ Form::text('choice_1', Request::old('choice_1'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('choice_2', '2nd Choice') }}
                                    {{ Form::text('choice_2', Request::old('choice_2'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('choice_3', '3rd Choice') }}
                                    {{ Form::text('choice_3', Request::old('choice_3'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('choice_4', '4th Choice') }}
                                    {{ Form::text('choice_4', Request::old('choice_4'), array('class' => 'form-control')) }}
                                </div>
                              </div>
                              <div class="modal-footer create-bottom-wrapper">
                                 <a href="{{ URL::to('quizzes/' . $value->quiz_id . '/questions') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
                                 {{ Form::submit('Add Question', array('class' => 'btn btn-primary create-btn text-center')) }}
                              </div>
                              {{ Form::close() }}
                            </div>
                          </div>
                        </div>
                                        
                            
                    <br>
                    <br>
                @endforeach
        </section>
    </main>



@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('quizzes');
        a.classList.toggle("active");
    });
    $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #bookId").val( myBookId );
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
    });


    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>