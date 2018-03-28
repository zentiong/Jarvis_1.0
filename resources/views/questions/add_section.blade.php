@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')

    <main class="container-fluid">
        <section class="container create-page">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">Add Section for this Quiz</h1>
            </div>

            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            <?php
                $section_skills = array();
            ?>

            @foreach($sections as $key => $section)
            <?php
                array_push($section_skills, $section->skill_id)
            ?>
            @endforeach

            {{ Form::open(array('url' => 'quizzes/'.$quiz_id.'/store_section')) }}

                <div id="div1">
                    <div class="form-group">
                        {{ Form::label('skill', 'Skill') }}
                        <select id="skill_id" class="form-control" name="skill_id">
                        @foreach($skills as $key => $skill)
                            <?php
                                $taken = false;
                            ?>
                            @foreach($section_skills as $key => $section_skill)
                                @if($skill->id == $section_skill)
                                <?php
                                    $taken = true;
                                ?>
                                @endif
                            @endforeach
                            @if($taken == false)
                                <option value="<?php echo $skill->id ?>">{{$skill->name}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ url()->previous() }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Add Section', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>
                
            {{ Form::close() }}

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