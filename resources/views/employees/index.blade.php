@extends('templates.newsletter-master')

@section('body')
<h1>All the Employees</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Employee ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Email</td>
            <td>Hiring Date</td>
            <td>Birth Date</td>
            <td>Department</td>
            <td>Supervisor ID</td>
            <td>Position</td>
            <td>HR?</td>
            <td>Manager?</td>
        </tr>
    </thead>
    <tbody>
    @foreach($employees as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->first_name }}</td>
            <td>{{ $value->last_name }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->hiring_date }}</td>
            <td>{{ $value->birth_date }}</td>
            <td>{{ $value->department }}</td>
            <td>{{ $value->supervisor_id }}</td>
            <td>{{ $value->position }}</td>
            <td>{{ $value->hr_check }}</td>
            <td>{{ $value->manager_check }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the employee (uses the destroy method DESTROY /employees/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                    {{ Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Employee', array('class' => 'btn btn-warning')) }}
                 {{ Form::close() }}
                <!-- show the employee (uses the show method found at GET /employees/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('users/' . $value->id) }}">Show this Employee</a>

                <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('users/' . $value->id . '/edit') }}">Edit this Employee</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection