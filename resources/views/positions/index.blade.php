@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('positions');
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
                <h1 class="crud-page-title">Current Positions</h1>
                <button class="btn crud-main-cta" type="button" data-toggle="modal" data-target="#createModal">&#43; Add Position</button>
            </div>
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            {{ Html::ul($errors->all()) }}

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Positions</td>
                        <td>Knowledge-based Weight</td>
                        <td>Skills-based Weight</td>
                        <td class="no-stretch">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($positions as $key => $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->knowledge_based_weight }}</td>
                        <td>{{ $value->skills_based_weight }}</td>
                        
                        <td class="table-actions no-stretch">
                             <!-- show the employee (uses the show method found at GET /employees/{id} -->
                            <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View position" href="{{ URL::to('positions/' . $value->id) }}">
                                <i class="fa fa-user fa-lg"></i>
                            </a>

                            <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                            <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit position" href="{{ URL::to('positions/' . $value->id . '/edit') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>

                                {{ Form::open(array('url' => 'positions/' . $value->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <div data-toggle="tooltip" data-placement="bottom" title="Remove position">
                                    {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                                </div>
                                <!-- {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }} -->
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
                <h5 class="modal-title" id="exampleModalLabel">Add Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ Form::open(array('url' => 'positions')) }}
                <div class="form-group">
                    {{ Form::label('name', 'Position Name') }}
                    {{ Form::text('name', Request::old('name'), array('class' => 'form-control', 'autofocus')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('knowledge_based_weight', 'Knowledge-Based Weight') }}
                    {{ Form::text('knowledge_based_weight', Request::old('knowledge_based_weight'), array('class' => 'form-control', 'autofocus')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('skills_based_weight', 'Skills-Based Weight') }}
                    {{ Form::text('skills_based_weight', Request::old('skills_based_weight'), array('class' => 'form-control', 'autofocus')) }}
                </div>

              </div>
              <div class="modal-footer create-bottom-wrapper">
                <a href="{{ URL::to('positions') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
                {{ Form::submit('Create position', array('class' => 'btn btn-primary create-btn text-center')) }}
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>

    </main>
    
@endsection