@extends('templates.dashboard-master')

@section('body')

	<main class="container create-page">
		<section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">Edit Link</h1>
                <h5>{{ $link->title }}</h5>
            </div>
            <a href="{{ URL::to('services') }}" class="btn cancel-btn">Back to All Services</a>
        </section>
        <hr>
        <section>
        	<!-- if there are creation errors, they will show here -->
            @if (Session::has('errors'))
                <div class="alert alert-warning" role="alert">
                    <strong>Warning</strong>
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif

			{{ Form::model($link, 
			array('route' => array('links.update', $link->id), 'method' => 'PUT', 'files' => true)) }}

                <div class="form-group">
                    {{Form::label('link_photo', 'Logo',['class' => 'control-label'])}}
                    <div class="form-control user-photo">{{Form::file('link_photo')}} 
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

				<div class="form-group text-center create-bottom-wrapper">
					<a href="{{ URL::to('services') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
				</div>  

			    <!-- {{ Form::submit('Edit service', array('class' => 'btn btn-primary')) }} -->

			{{ Form::close() }}
        </section>
	</main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('Services');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>