
<?php
    $evals_to_take = array(); // user trainings where quiz has already been training
    $quizzes_taken_id = array();
    $quizzes_taken = array();
    $training_quiz_taken = array();
    $quizzes_to_take = array();
    $user_trainings_taken = array();
    $trainings_taken = array(); 
?>
    <!-- QUIZZES TO TAKE -->
    @foreach($user_trainings as $key => $user_training)
        @if(($user_training->user_id == $current_id)and($user_training->confirmed == true))
            <?php
                array_push($user_trainings_taken, $user_training)
            ?>
        @endif
    @endforeach

    @foreach($trainings as $key => $training)
        @foreach($user_trainings_taken as $key => $user_training_taken)
            @if(($training->id == $user_training_taken->training_id)and($training->date))
                <?php
                array_push($trainings_taken, $training)
                ?>
            @endif
        @endforeach
    @endforeach

    @foreach($trainings_taken as $key => $training_taken)
        @foreach($quizzes as $key => $quiz)
            @if($training_taken->id == $quiz->training_id)
                <?php
                    array_push($quizzes_to_take, $quiz)
                ?>
            @endif
        @endforeach        
    @endforeach

    <div class="row">
        <div class="dashboard-content col-md-6">
            <h6 class="content-header light">
                <b>Quizzes to take</b>
            </h6>      
            @foreach($quizzes_to_take as $key => $quiz_to_take)
                <?php
                    $taken = false;
                ?>
                @foreach($user_quizzes as $key => $user_quiz)
                <?php
                    if(($user_quiz->user_id==$current_id)and($quiz_to_take->quiz_id==$user_quiz->quiz_id)and($user_quiz->status==1)) // if passed
                    {
                        $taken = true;
                    }

                    if($user_quiz->retaken>0)
                    {
                        $taken = true;
                    }
                ?>
                @endforeach
                @if($taken == false)
                    <div class="trainings-box">
                        <span>{{ $quiz_to_take->topic }}</span>
                        {{ Form::open(array('url' => 'verify_pw')) }}
                        {{ Form::hidden('quiz_id', $value = $quiz_to_take->quiz_id) }}
                        {{ Form::button('ANSWER', array('type' => 'submit', 'class' => 'btn take-quiz-btn', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom','title' => 'Take quiz')) }}
                        {{ Form::close() }}
                    </div> 
                @endif
            @endforeach
        </div>
    <!-- Get Quiz IDS 
    -->
    @foreach($user_quizzes as $key => $user_quiz) 
        @if($user_quiz->user_id == $current_id)
        <?php
            array_push($quizzes_taken_id,$user_quiz->quiz_id);
        ?>
        @endif
    @endforeach

    <!-- Get Quizzes
    -->
    <!-- error here -->

    @foreach($quizzes_taken_id as $key => $quiz_taken_id) 
        @foreach($quizzes as $key => $quiz) 
            @if($quiz->quiz_id == $quiz_taken_id)
            <?php
                array_push($quizzes_taken,$quiz);
            ?>
            @endif
        @endforeach
    @endforeach

    <!-- Get trainings -->

    @foreach($quizzes_taken as $key => $quiz_taken) 
        @foreach($trainings_taken as $key => $training_taken) 
            @if($quiz_taken->training_id == $training_taken->id)
            <?php
                array_push($training_quiz_taken,$training_taken);
                
            ?>
            @endif
        @endforeach
    @endforeach

    <!-- Get trainings -->
    
    @foreach($user_trainings as $key => $user_training) 
        @foreach($training_quiz_taken as $key => $answered) 
            
            @if($user_training->training_id == $answered->id)
            <?php
                if(!in_array($user_training, $evals_to_take))
                {
                array_push($evals_to_take,$user_training);
            }
            ?>

            @endif
        @endforeach
    @endforeach
    
    <!-- error here -->
        <div class="dashboard-content col-md-6">
            <h6 class="content-header light">
                <b>Evaluations to take</b>
            </h6>
            @foreach($evals_to_take as $key => $eval)
                @if($eval->evaluation==null)
                {{ Form::open(array('url' => 'evaluate')) }}
                <div class="trainings-box">
                    @foreach($trainings_taken as $key => $training)
                        @if($training->id == $eval->training_id)
                            <span>{{$training->title}}</span>

                            {{ Form::hidden('training_id', $value = $eval->training_id) }}
                            {{ Form::button('EVALUATE', array('type' => 'submit', 'class' => 'btn take-quiz-btn', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom','title' => 'Provide feedback')) }}
                            {{ Form::close() }}
                        @endif
                    @endforeach 
                </div>
                @endif
            @endforeach
        </div>
    </div>
