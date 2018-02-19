@extends('templates.dashboard-master')

@section('body')
<h1>Current Positions</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Positions</td>
            <td>Total</td>
        </tr>
    </thead>
    <tbody>
    @foreach($positions as $key => $value)
        <tr>
            <td>{{ $value->name }}</td>
            
            <td>

                    {{ Form::open(array('url' => 'positions/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                 {{ Form::close() }}
                <!-- show the employee (uses the show method found at GET /employees/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('positions/' . $value->id) }}">Show</a>

                <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('positions/' . $value->id . '/edit') }}">Edit</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection