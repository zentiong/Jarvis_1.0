@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('assessments');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>

<?php
    $temp_skills = array();
?>

@section('body')
    <main class="contaiuner fluid">
        <section class="container-fluid">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">All Assessments</h1>
                <button class="btn crud-main-cta" type="button" data-toggle="modal" data-target="#createModal">&#43; Add Assessment</button>
            </div>

            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <?php 
            $user_id = Auth::user()->id;
            ?>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td  class="no-stretch">Assessment ID</td>
                        <td> Skill </td>
                        <td class="no-stretch">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($assessments as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        @foreach($skills as $key => $skill)
                            @if($skill->id == $value->skill_id)
                                <td> {{$skill->name}}</td>
                                <?php 
                                    array_push($temp_skills, $skill)
                                ?>
                            @endif
                        @endforeach

                        <!-- we will also add show, edit, and delete buttons -->
                        <td class="table-actions">

                            
                            <!-- show the quiz (uses the show method found at GET /assessments/{id} -->
                            <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View assessment"  href="{{ URL::to('assessments/' . $value->id) }}">
                                <i class="fa fa-user fa-lg"></i>
                            </a>

                            <!-- edit this quiz (uses the edit method found at GET /assessments/{id}/edit -->
                            <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit assessment" href="{{ URL::to('assessments/' . $value->id . '/edit') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>

                            <!-- delete the quiz (uses the destroy method DESTROY /assessments/{id} -->
                            <!-- we will add this later since its a little more complicated than the other two buttons -->
                            {{ Form::open(array('url' => 'assessments/' . $value->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            <div data-toggle="tooltip" data-placement="bottom" title="Delete assessment" >
                                {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                            </div>
                            {{ Form::close() }}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </section>
        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Assessment Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ Form::open(array('url' => 'assessments')) }}
                <?php /*
                <div class="form-group">
                    {{ Form::label('topic', 'Topic') }}
                    {{ Form::text('topic', Request::old('topic'), array('class' => 'form-control', 'autofocus')) }}
                </div>
                */ ?>

                <div class="form-group">
                    {{ Form::label('skill_id', 'Relevant skill') }}
                    <select id="skill" class="form-control" name="skill">
                        @foreach($skills as $key => $value)
                            @if(!in_array($value,$temp_skills))
                            <option value="<?php echo $value->id ?>">{{$value->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="modal-footer create-bottom-wrapper">
                <a href="{{ URL::to('assessments') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
                {{ Form::submit('Create assessment', array('class' => 'btn btn-primary create-btn text-center')) }}
              </div>
              
              {{ Form::close() }}
            </div>
          </div>
        </div>

    </main>


@endsection