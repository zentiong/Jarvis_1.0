@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
            <td>Starting Time</td>  
            <td>Ending Time</td>            
            <td>Title</td>
            <td>Speaker</td>
            <td>Venue</td>
        </tr>
    </thead>
    <tbody>
    @foreach($training_sessions as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->date }}</td>
            <td>{{ $value->starting_time }}</td>
            <td>{{ $value->ending_time }}</td>
            <td>{{ $value->title }}</td>
            <td>{{ $value->speaker }}</td>
            <td>{{ $value->venue }}</td>

            <td>

                    {{ Form::open(array('url' => 'training_sessions/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                 {{ Form::close() }}
                <!-- show the employee (uses the show method found at GET /employees/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('training_sessions/' . $value->id) }}">Show</a>

                <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('training_sessions/' . $value->id . '/edit') }}">Edit</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection