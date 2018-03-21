@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <h1 class="crud-page-title">Change Profile Photo: {{ $user->first_name }} {{ $user->last_name }}</h1>
        </section>
        <section>
            <!-- if there are creation errors, they will show here -->
            @if (Session::has('errors'))
                    <div class="alert alert-info">{{ Html::ul($errors->all()) }}</div>
            @endif

            
            {{ Form::open(array('url' => 'store_dp','files'=>true)) }}

                <div class="form-group">
                    {{Form::label('user_photo', 'Profile Picture',['class' => 'control-label'])}}
                    <div class="form-control user-photo">{{Form::file('user_photo'),Request::old('profile_photo') }} 
                    </div>
                </div>

                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('users') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>
                
            {{ Form::close() }}
        </section>
    </main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('users');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>