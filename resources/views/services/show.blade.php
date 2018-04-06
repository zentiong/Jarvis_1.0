@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">{{ $service->name }}</h1>
            </div>
            <a href="{{ URL::to('services') }}" class="btn cancel-btn">Back to All Services</a>
        </section>
        <hr>
        <button class="btn crud-main-cta" type="button" data-toggle="modal" data-target="#createModal">&#43; Add Links</button>


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
                {{ Form::open(array('url' => 'links', 'files'=>true)) }}
                {{ Form::hidden('service_id', $value = $service->id) }}
                <div class="form-group">
                    {{Form::label('link_photo', 'Logo',['class' => 'control-label'])}}
                    <div class="form-control user-photo">{{Form::file('user_photo'),Request::old('profile_photo') }} 
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', Request::old('title'), array('class' => 'form-control', 'autofocus', 'pattern' => '[a-zA-z ]+', 'required', 'title' => 'Please use alphabet characters only')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('description', 'Description') }}
                    {{ Form::text('description', Request::old('description'), array('class' => 'form-control', 'autofocus', 'pattern' => '[a-zA-z ]+', 'required', 'title' => 'Please use alphabet characters only')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('link', 'Where does this link to?') }}
                    {{ Form::text('link', Request::old('link'), array('class' => 'form-control', 'autofocus', 'pattern' => '[a-zA-z ]+', 'required', 'title' => 'Please use alphabet characters only')) }}
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