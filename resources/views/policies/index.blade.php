@extends('templates.dashboard-master')

@section('body')

    <main class="container-fluid">
        <section class="container">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">Policies</h1>
                <button class="btn crud-main-cta" type="button" data-toggle="modal" data-target="#createModal">&#43; Add Policy</button>
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
                             <td>Logo</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Reference</td>
                            <td class="no-stretch">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($policies as $key => $value)
                        <tr>
                            <td><img src="{{ asset( 'images/policy_photos/'.$value->logo) }}" style="height: 50px; width: 50px;"> </td>
                            <td>{{ $value->title }}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->link }}</td>

                            <td class="table-actions no-stretch">
                                 <!-- show the employee (uses the show method found at GET /employees/{id} -->
                                <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                                <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit Policy" href="{{ URL::to('policies/' . $value->id . '/edit') }}">
                                    <i class="fa fa-pencil fa-lg"></i>
                                </a>

                                    {{ Form::open(array('url' => 'policies/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    <div data-toggle="tooltip" data-placement="bottom" title="Remove Policy">
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
                <h5 class="modal-title" id="exampleModalLabel">Add Policy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
               <div class="modal-body">
                {{ Form::open(array('url' => 'policies', 'files'=>true)) }}
                <div class="form-group">
                    {{Form::label('policy_photo', 'Logo',['class' => 'control-label'])}}
                    <div class="form-control user-photo">{{Form::file('policy_photo')}} 
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', Request::old('title'), array('class' => 'form-control', 'autofocus', 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('description', 'Description') }}
                    {{ Form::text('description', Request::old('description'), array('class' => 'form-control', 'autofocus', 'required' )) }}
                </div>
                <div class="form-group">
                    {{ Form::label('link', 'Where does this link to?') }}
                    {{ Form::text('link', Request::old('link'), array('class' => 'form-control', 'autofocus', 'required')) }}
                </div>

              </div>
              <div class="modal-footer create-bottom-wrapper">
                <a href="{{ URL::to('positions') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
                {{ Form::submit('Create Policy', array('class' => 'btn btn-primary create-btn text-center')) }}
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
        var a = document.getElementById('policies');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>