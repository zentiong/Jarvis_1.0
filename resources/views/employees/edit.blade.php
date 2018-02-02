@extends('templates.newsletter-master')

@section('body')
<h1>Edit {{ $employee->first_name }} {{ $employee->last_name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}


{{ Form::model($employee, array('route' => array('users.update', $employee->employee_id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('first_name', 'First Name') }}
        {{ Form::text('first_name', Request::old('first_name'), array('class' => 'form-control')) }}
    </div>

     <div class="form-group">
        {{ Form::label('last_name', 'Last Name') }}
        {{ Form::text('last_name', Request::old('last_name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', Request::old('email'), array('class' => 'form-control')) }}
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

    <!-- Department -->

    <div class="form-group">
        {{ Form::label('department', 'Department') }}
        {{ Form::select('department', array('0' => 'Select a Department', '1' => 'Finance', '2' => 'Human Resources', '3' => 'Customer Service'), Request::old('department'), array('class' => 'form-control')) }}
    </div>

    <!-- Supervisor ID -->

    <div class="form-group">
        {{ Form::label('supervisor_id', 'Supervisor ID') }}
        {{ Form::text('supervisor_id', Request::old('supervisor_id'), array('class' => 'form-control')) }}
    </div>

    <!-- Position -->
    <div class="form-group">
        {{ Form::label('position', 'Position') }}
        {{ Form::select('position', array('0' => 'Select a Position', '1' => 'President', '2' => 'Secretary', '3' => 'Developer'), Request::old('position'), array('class' => 'form-control')) }}
    </div>

    <!-- HR? -->

    <div class="form-group">
        {{ Form::label('hr_check', 'HR?') }}
        {{ Form::checkbox('hr_check', '1', Request::old('hr_check'), array('class' => 'form-control')) }}

        
    </div>

    <!-- Manager? -->

    <div class="form-group">
        {{ Form::label('manager_check', 'Manager?') }}
        {{ Form::checkbox('manager_check', '1', Request::old('manager_check'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Employee!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection