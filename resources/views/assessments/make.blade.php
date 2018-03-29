@extends('templates.dashboard-master')


@section('body')

 <main class="container create-page">
        <section class="row crud-page-top">
            <h1 class="crud-page-title">Make a  
                    @foreach($skills as $key => $skill)
                        @if($skill->id == $assessment->skill_id)
                            {{$skill->name}}
                        @endif
                    @endforeach Assessment </h1>
        </section>
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
        <h5>{{ Form::label('user', 'Employee') }}</h5>
  
        <select id="user" class="form-control" name="user">
        @foreach($users as $key => $value)
            <option value="<?php echo $value->id ?>">
                {{$value->first_name}} {{$value->last_name}}
            </option>
        @endforeach
        </select>

    </div>

    <table class="table table-striped table-bordered">
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
            <td>

                {{ Form::radio('grades['.$i.']', '1' ) }}
                {{ Form::radio('grades['.$i.']', '2' ) }}
                {{ Form::radio('grades['.$i.']', '3' ) }}
                {{ Form::radio('grades['.$i.']', '4' ) }}
                {{ Form::radio('grades['.$i.']', '5' ) }}

                <?php
                   $i++;
                ?>
                
            </td>

        </tr>

    @endforeach
    </tbody>

     {{ Form::hidden('ideal_count', $value = $i) }}
   
    </table>

    <?php
        $i;
    ?>


   <div style="padding-top: 30px"> 
   <h5> {{ Form::label('feedback', 'Feedback') }}</h5>
    {{ Form::text('feedback', Request::old('feedback'), array('class' => 'form-control', 'required')) }}


   <div style="padding-top: 50px">{{ Form::submit('Submit Ratings!', array('class' => 'btn crud-main-cta')) }}</div>

   {{ Form::close() }}
   </div>

</main>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>