@extends('templates.newsletter-master')

@section('body')
<h1>Training Sessions</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Date</td>
            <td>Description</td>
            <td>Speaker</td>
            <td>Venue</td>
        </tr>
    </thead>
    <tbody>
    @foreach($training_sessions as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->date }}</td>
            <td>{{ $value->description }}</td>
            <td>{{ $value->speaker }}</td>
            <td>{{ $value->venue }}</td>

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