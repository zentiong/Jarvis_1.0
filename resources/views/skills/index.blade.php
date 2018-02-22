@extends('templates.dashboard-master') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('skills');
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
                <h1 class="crud-page-title">All Skills</h1>
                <button class="btn crud-main-cta" type="button" data-toggle="modal" data-target="#createModal">&#43; Add Skill</button>
            </div>

            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <?php 
            $user_id = Auth::user()->id;
            ?>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Skill Name</td>
                        <td>Description</td>
                        <td class="no-stretch">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($skills as $key => $value)
                    <tr>
                        

                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name}}</td>
                        <td>{{ $value->description}}</td>

                        <td class="table-actions">
                            <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit skill" href="{{ URL::to('skills/' . $value->id . '/edit') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>
                            {{ Form::open(array('url' => 'skills/' . $value->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            <div data-toggle="tooltip" data-placement="bottom" title="Remove skill">
                                <!-- {{ Form::submit('Delete', array('class' => 'btn delete-btn')) }} -->
                                {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                            </div>
                            
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>

        </section>

        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Skill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ Form::open(array('url' => 'skills')) }}

                <div class="form-group"> 
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', Request::old('name'), array('class' => 'form-control', 'autofocus')) }}
                </div>
                <div class="form-group"> 
                    {{ Form::label('description', 'Description') }}
                    {{ Form::text('description', Request::old('description'), array('class' => 'form-control')) }}
                </div>
              </div>
              <div class="modal-footer create-bottom-wrapper">
                <a href="{{ URL::to('skills') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
                {{ Form::submit('Create skill', array('class' => 'btn btn-primary create-btn text-center')) }}
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>

    </main>

@endsection