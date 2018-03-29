@extends('templates.dashboard-master')

                
@section('body')
     <main class="container create-page">
        <section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">Chooose employees</h1> 
                <h6>{{$training->title}}</h6>
            </div>
            <p><strong>STEP 2: Give recommendations</strong></p>
        </section>
        <section>
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info">
                        <strong>Heads up</strong>
                        {{ Session::get('message') }}
                    </div>
                @endif
                {{ Form::open(array('url' => 'recommend_fire')) }}
                {{ Form::hidden('training', $value = $training) }}

                <div class="form-group">

                    <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>Actions</td>
                            <td>Employee Name</td>
                            
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($users as $key => $user)
                            @if($user->id!=Auth::user()->id)
                            <?php
                                $recommended = false;
                            ?>
                            <tr>
                                <td class="table-actions">
                                @foreach($user_trainings as $key => $user_training)
                                    @if(($user_training->training_id == $training->id)and($user_training->user_id==$user->id))
                                        <?php
                                            $recommended = true;
                                        ?>
                                    @endif
                                @endforeach

                                @if($recommended)
                                    Already Recommended
                                @else
                                {{ Form::checkbox($user->id,$user->id, true) }}
                            
                                @endif 
                                </td>
                                <td>
                                {{ Form::label($user->id, $user->first_name.' '.$user->last_name) }}
                                </td>
                            </tr>
                            @endif
                        @endforeach

                    </tbody>
                    </table>
                   
                </div>

                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('recommend') }}" class="btn cancel-btn">Go back</a>
                    {{ Form::submit('Recommend', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>
                {{ Form::close() }}
            </div>
        </section>
    </main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('levels');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>