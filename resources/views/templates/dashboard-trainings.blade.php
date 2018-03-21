<div class="col-md-5">
        <h5 class="dashboard-header">Trainings</h5>
        @if($mg==1)
        <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="Recommend Trainings" href="{{ URL::to('recommend')}}">Recommend Trainings to your Employees</a>
        @endif
        @if(!empty($trainings_personal))
        <div class="dashboard-content">
            <div class="recommended-wrapper">
                <h6 class="content-header dark"><b>Recommended Trainings</b></h6>
                @foreach($trainings_personal as $key => $training)
                    <div class="trainings-box">
                        <div>
                            <!-- text -->
                            <p>
                                <b>{{$training->title}}</b>
                            </p>
                            <span>
                                {{date('h:i', strtotime($training->starting_time))}}
                            </span>
                            <span>
                                - {{date('h:i a', strtotime($training->ending_time))}}
                            </span>
                            <span>
                                | {{date('F d', strtotime($training->date))}}
                            </span>
                            <p>
                                {{$training->venue}}
                            </p>
                        </div>
                        <div>
                            <!-- button -->
                            @foreach($user_trainings as $key => $user_training)
                            @if($user_training->training_id == $training->id) 
                                @if($user_training->confirmed == false)
                                    {{ Form::open(array('url' => 'confirm')) }}
                                    {{ Form::hidden('training_id', $value = $training->id) }}
                                    {{ Form::hidden('user_id', $value = Auth::user()->id) }}
                                    {{ Form::submit('SIGN UP', array('class' => 'btn text-center sign-up-btn light')) }}
                                    {{ Form::close() }}
                                @else
                                    <span class=" going-state light">&#x2714; I'M GOING</span>
                                @endif             
                            @endif
                        @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="dashboard-content">
            <div class="incoming-wrapper">
                <h6 class="content-header light"><b>Trainings this month</b></h6>
                @foreach($trainings_general as $key => $training)
                    {{ $present = false }} 
                    <div class="trainings-box">
                        <div>
                            <!-- text -->
                            <p><b>{{$training->title}}</b></p>
                            <span>
                                {{date('h:i', strtotime($training->starting_time))}}
                            </span>
                            <span>
                                - {{date('h:i a', strtotime($training->ending_time))}}</span>
                            <span>
                                | {{date('F d', strtotime($training->date))}}
                            </span>
                            <p>{{$training->venue}}</p>
                        </div>
                        <div>
                            @foreach($user_trainings as $key => $user_training)
                                @if($user_training->training_id == $training->id) 
                                    <?php
                                        $present = true 
                                    ?>
                                @endif
                            @endforeach
                            @if($present==false) 
                                {{ Form::open(array('url' => 'signup')) }}
                                {{ Form::hidden('user_id', $value = Auth::user()->id) }}
                                {{ Form::hidden('training_id', $value = $training->id) }}
                                {{ Form::submit('SIGN UP', array('class' => 'btn text-center sign-up-btn outline')) }}
                                {{ Form::close() }}
                            @else
                                @if($user_training->confirmed == true)
                                    <span class="going-state dark">
                                        &#x2714; I'M GOING
                                    </span> 
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>