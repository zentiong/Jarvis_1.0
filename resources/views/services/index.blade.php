@extends('templates.dashboard-master')

@section('body')

    <main class="container-fluid">
        <section class="container">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">Services</h1>
                <button class="btn crud-main-cta" type="button" data-toggle="modal" data-target="#createModal">&#43; Add Service</button>
            </div>
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
            <div class="horizontal-scroll">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td class="no-stretch">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $key => $value)
                        <tr>
                            <td>{{ $value->name }}</td>
                            
                            <td class="table-actions no-stretch">
                                 <!-- show the employee (uses the show method found at GET /employees/{id} -->
                                <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View Service" href="{{ URL::to('services/' . $value->id) }}">
                                    <i class="fa fa-user fa-lg"></i>
                                </a>

                                <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                                <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit Service" href="{{ URL::to('services/' . $value->id . '/edit') }}">
                                    <i class="fa fa-pencil fa-lg"></i>
                                </a>

                                    {{ Form::open(array('url' => 'services/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    <div data-toggle="tooltip" data-placement="bottom" title="Remove Service">
                                        {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                                    </div>
                                    <!-- {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }} -->
                                 {{ Form::close() }}
                               
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ Form::open(array('url' => 'services')) }}
                <div class="form-group">
                    {{ Form::label('name', 'Service Name') }}
                    {{ Form::text('name', Request::old('name'), array('class' => 'form-control', 'autofocus', 'pattern' => '[a-zA-z ]+', 'required', 'title' => 'Please use alphabet characters only')) }}
                </div>

              </div>
              <div class="modal-footer create-bottom-wrapper">
                <a href="{{ URL::to('positions') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
                {{ Form::submit('Create Service', array('class' => 'btn btn-primary create-btn text-center')) }}
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>

    </main>
    
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('services');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>