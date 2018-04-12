@extends('templates.dashboard-master')


@section('body')

 <main class="container create-page">
        <section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">Making an assessment</h1>    
                @foreach($skills as $key => $skill)
                    @if($skill->id == $assessment->skill_id)
                        <h5>Skill: {{$skill->name}}</h5>
                    @endif
                @endforeach
            </div>
            
            <a href="{{ url()->previous() }}" class="btn cancel-btn">Go Back</a>
        </section>
        <hr>
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info" role="alert">
                <strong>Heads up</strong>
                {{ Session::get('message') }}
            </div>
        @endif

        <!-- if there are creation errors, they will show here -->
        @if (Session::has('errors'))
            <div class="alert alert-warning" role="alert">
                <strong>Warning</strong>
                {{ Html::ul($errors->all()) }}
            </div>
        @endif

        {{ Form::open(array('url' => 'assessments/'.$assessment->id.'/record')) }}

        {{ Form::hidden('supervisor_id', $value = Auth::user()->id) }}
        {{ Form::hidden('assessment_id', $value = $assessment->id) }}


        <div class="form-group">
            <h6><strong>Select {{ Form::label('user', 'employee') }}</h6></strong>
            <select id="user" class="form-control" name="user">
            @foreach($users as $key => $value)
                <option value="<?php echo $value->id ?>">
                    {{$value->first_name}} {{$value->last_name}}
                </option>
            @endforeach
            </select>
        </div>
        <h6><strong>Rate criteria</strong></h6>
        <div class="evaluate-training-wrapper">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="no-stretch">Criteria</td>
                        <td>Rating (left-most being the lowest)</td>
                    </tr>
                </thead> 
                <tbody>
                <?php 
                    $i = 0
                ?>
                @foreach($assessment_items as $key => $value)
                    <tr>
                        <td>{{ $value->criteria }}</td>
                        <td class="text-center">
                            <div data-toggle="buttons">
                                <div class="evaluate-item-row btn">
                                    {{ Form::radio('grades['.$i.']', '1' ) }}
                                    {{ Form::label('grades['.$i.']', '1') }}
                                </div>
                                <div class="evaluate-item-row btn">
                                    {{ Form::radio('grades['.$i.']', '2' ) }}
                                    {{ Form::label('grades['.$i.']', '2') }}
                                </div>
                                 <div class="evaluate-item-row btn">
                                    {{ Form::radio('grades['.$i.']', '3' ) }}
                                    {{ Form::label('grades['.$i.']', '3') }}
                                </div>
                                <div class="evaluate-item-row btn">
                                    {{ Form::radio('grades['.$i.']', '4' ) }}
                                    {{ Form::label('grades['.$i.']', '4') }}
                                </div>
                                <div class="evaluate-item-row btn">
                                    {{ Form::radio('grades['.$i.']', '5' ) }}
                                    {{ Form::label('grades['.$i.']', '5') }}
                                </div>
                            </div>
                            <?php
                               $i++;
                            ?> 
                        </td>
                    </tr>
                @endforeach
                {{ Form::hidden('ideal_count', $value = $i) }}
                <?php
                    $i;
                ?>
                </tbody>
            </table>
        </div>
        

       <div class="form-group"> 
           <h6><strong>{{ Form::label('feedback', 'Feedback') }}</h6></strong>
            {{ Form::text('feedback', Request::old('feedback'), array('class' => 'form-control', 'required')) }}
       </div>

        <div class="form-group text-center create-bottom-wrapper">
            <a href="{{ URL::to('levels') }}" class="btn cancel-btn">Cancel</a>
            {{ Form::submit('Submit ratings', array('class' => 'btn btn-primary create-btn text-center')) }}
        </div>
        {{ Form::close() }}

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