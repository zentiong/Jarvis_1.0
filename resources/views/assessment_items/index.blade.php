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

@section('body')
    <main class="container-fluid">
        <section class="container-fluid">
            <div class="row crud-page-top">
                 @foreach($skills as $key => $skill)
                            @if($skill->id == $assessment->skill_id)
                                <h1 class="crud-page-title">Assessment for: {{$skill->name}}</h1>
                              
                                
                            @endif
                        @endforeach
                
                <button class="btn crud-main-cta" type="button" data-toggle="modal" data-target="#createModal">&#43; Add Assessment Item</button>
            </div>

            <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

         
         <br>
         <br>

            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Criteria </td>
                    <td class="no-stretch">Actions</td>
                </tr>
            </thead>

            <tbody>
            @foreach($assessment_items as $key => $value)
                <tr>
                    <td>{{ $value->criteria }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td class="table-actions">

                        
                       
                        <!-- edit this assessment (uses the edit method found at GET /assessments/{id}/edit -->
                        <!-- -->
                        <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit this item" href="{{ URL::to('assessments/'.$assessment->id.'/assessment_items/'.$value->id.'/edit') }}">
                            <i class="fa fa-pencil fa-lg"></i>
                        </a>

                        <!-- delete the assessment (uses the destroy method DESTROY /assessments/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                            {{ Form::open(array('url' => 'assessments/'.$assessment->id.'/assessment_items/' . $value->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            <div data-toggle="tooltip" data-placement="bottom" title="Delete this item" >
                                {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                            </div>
                         {{ Form::close() }}
                        
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </section>

        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Assessment Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               {{ Form::open(array('url' => 'assessments/'.$assessment->id.'/assessment_items')) }}
                <div class="form-group" >
                    {{ Form::label('criteria', 'Criteria') }}
                    {{ Form::text('criteria', Request::old('criteria'), array('class' => 'form-control', 'autofocus')) }}
                </div>

                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('assessments/'.$assessment->id.'/assessment_items') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>
                
            {{ Form::close() }}

            </div>
          </div>
        </div>
    </main>

    


@endsection