@extends('templates.dashboard-master')

@section('body')
    <main class="container create-page">
        <section class="row crud-page-top">
            <h1 class="crud-page-title">Create Employee</h1>
            <a href="{{ URL::to('users') }}" class="btn cancel-btn">Back to All Employees</a>
        </section>

        <section>
            <!-- if there are creation errors, they will show here -->
            @if (Session::has('errors'))
                <div class="alert alert-warning" role="alert">
                    <strong>Warning</strong>
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif

            {{ Form::open(array('url' => 'users','files'=>true)) }}

                <div class="form-group">
                    {{Form::label('user_photo', 'Profile Picture',['class' => 'control-label'])}}
                    <div class="form-control user-photo">{{Form::file('user_photo'),Request::old('profile_photo') }} 
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-6">
                        <!-- FIRST NAME -->
                        <div class="form-group">
                            {{ Form::label('first_name', 'First Name') }}
                            {{ Form::text('first_name', Request::old('first_name'), array('class' => 'form-control', 'autofocus')) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- LAST NAME -->
                         <div class="form-group">
                            {{ Form::label('last_name', 'Last Name') }}
                            {{ Form::text('last_name', Request::old('last_name'), array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email', Request::old('email'), array('class' => 'form-control')) }}
                </div>
                
                <!-- PASSWORD -->
                <div class="form-group">
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password', Request::old('password'), array('class' => 'form-control')) }}
                </div>

                <!-- Hiring Date -->
                <div class="form-group">
                    {{ Form::label('hiring_date', 'Hiring Date') }}
                    {{ Form::date('hiring_date', Request::old('hiring_date'), array('class' => 'form-control')) }}
                </div>

                <!-- Birth Date -->
                <div class="form-group">
                    {{ Form::label('birth_date', 'Birth Date') }}
                    {{ Form::date('birth_date', Request::old('birth_date'), array('class' => 'form-control')) }}
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <!-- Department -->
                        <div class="form-group">
                            {{ Form::label('department', 'Department') }}
                            {{ Form::select('department', array('Finance' => 'Finance', 'Human Resources' => 'Human Resources', 'Customer Service' => 'Customer Service'), Request::old('department'), array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Position -->
                        {{ Form::label('position', 'Position') }}
                        <select id="position" class="form-control" name="position">
                            @foreach($positions as $key => $value)
                            <option value="<?php echo $value->name ?>">
                                {{$value->name}} 
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <!-- Supervisor -->
                    {{ Form::label('supervisor_id', 'Supervisor') }}
                    <select id="supervisor_id" class="form-control" name="supervisor_id">
                    @foreach($users as $key => $value)
                    <option value="<?php echo $value->id ?>">
                        {{$value->first_name}} {{$value->last_name}}
                    </option>
                    @endforeach
                    </select>
                </div>
                

                <!-- Manager? -->
                <div class="form-group">
                    {{ Form::label('manager_check', 'Manager?') }}
                    {{ Form::checkbox('manager_check', '1', Request::old('manager_check')) }}
                </div>

                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('users') }}" class="btn cancel-btn">Cancel</a>
                     {{ Form::submit('Create employee', array('class' => 'btn btn-primary create-btn text-center')) }}
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