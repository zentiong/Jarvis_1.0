<!-- @extends('templates.dashboard-master') -->

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <h1 class="crud-page-title">Edit {{ $user->first_name }} {{ $user->last_name }}</h1>
        </section>
        <section>
            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
                
                <div class="row">
                    <div class="col-md-6">
                        <!-- FIRST NAME -->
                        <div class="form-group">
                            {{ Form::label('first_name', 'First Name') }}
                            {{ Form::text('first_name', Request::old('first_name'), array('class' => 'form-control')) }}
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
                            {{ Form::select('department', array('0' => 'Select a Department', '1' => 'Finance', '2' => 'Human Resources', '3' => 'Customer Service'), Request::old('department'), array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Position -->
                        <div class="form-group">
                            {{ Form::label('position', 'Position') }}
                            {{ Form::select('position', array('0' => 'Select a Position', '1' => 'President', '2' => 'Secretary', '3' => 'Developer'), Request::old('position'), array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                
                <!-- Supervisor ID -->
                <div class="form-group">
                    {{ Form::label('supervisor_id', 'Supervisor ID') }}
                    {{ Form::text('supervisor_id', Request::old('supervisor_id'), array('class' => 'form-control')) }}
                </div>

                <!-- Manager? -->
                <div class="form-group">
                    {{ Form::label('manager_check', 'Manager?') }}
                    {{ Form::checkbox('manager_check', '1', Request::old('manager_check')) }}
                </div>
                
                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('users') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Save changes', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>
                
            {{ Form::close() }}
        </section>
    </main>


@endsection