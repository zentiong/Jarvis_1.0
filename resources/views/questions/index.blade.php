@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="crud-page-top">
            <h1 class="crud-page-title"> Showing questions for this quiz  </h1>
            <h5>({{ $quiz->topic }} )</h5>
        </section>
        <hr>
        <section>
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

             <!-- 
             <a href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/questions/create') }}" style="float: right;">Add a Question</a>
             -->
            <a href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/add_section') }}" class="btn crud-sub-cta">Add a section</a>
            <br>
            
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
                            <td class="no-stretch">Actions</td>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($questions as $key => $value)
                        
                        @if($value->section_id == $section->id)
                        <tr>
                            <td>{{ $value->question_item }}</td>
                            <td>{{ $value->answer_item }}</td>

                            <!-- we will also add show, edit, and delete buttons -->
                            <td class="table-actions">
                                <!-- show the quiz (uses the show method found at GET /quizzes/{id} -->
                                <!-- -->
                                <!-- <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View question" href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/questions/'.$value->id) }}">
                                    <i class="fa fa-user fa-lg"></i>
                                </a> -->

                                <!-- edit this quiz (uses the edit method found at GET /quizzes/{id}/edit -->
                                <!-- -->
                                <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit employee" href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/questions/'.$value->id.'/edit') }}">
                                    <i class="fa fa-pencil fa-lg"></i>
                                </a>

                                <!-- delete the quiz (uses the destroy method DESTROY /quizzes/{id} -->
                                <!-- we will add this later since its a little more complicated than the other two buttons -->
                                {{ Form::open(array('url' => 'quizzes/'.$quiz->quiz_id.'/questions/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    
                                    <div data-toggle="tooltip" data-placement="bottom" title="Remove question">
                                        {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'Remove', 'class' => 'btn delete-btn')) }}
                                    </div>
                                 {{ Form::close() }}
                                
                            </td>
                        </tr>

                        @endif

                    @endforeach
                    </tbody>
                    </table>
                    <!--
                    <a href="{{ URL::to('quizzes/'.$quiz->quiz_id.'/questions/create') }}" style="float: right;">Add a Question</a>
                    --> 

                        {{ Form::open(array('url' => 'quizzes/'.$quiz->quiz_id.'/questions/create', 'class' => 'pull-right')) }}
                            {{ Form::hidden('quiz_id', $quiz->quiz_id) }}
                            {{ Form::hidden('section_id', $section->id) }}
                            {{ Form::submit('Add Question', array('class' => 'btn question-btn text-center')) }}
                        {{ Form::close() }}
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
</script>