@extends('templates.dashboard-master')

@section('body')

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 
$user_id = Auth::user()->id;
?>



<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Assessment ID</td>
            <td>Topic</td>
        </tr>
    </thead>
    <tbody>
    @foreach($assessments as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->topic }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                
                <!-- show the quiz (uses the show method found at GET /assessments/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('assessments/' . $value->id) }}">Show this Assessment</a>

                <!-- edit this quiz (uses the edit method found at GET /assessments/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('assessments/' . $value->id . '/edit') }}">Edit this Assessment</a>

                <!-- delete the quiz (uses the destroy method DESTROY /assessments/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'assessments/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Assessment', array('class' => 'btn btn-warning')) }}
                 {{ Form::close() }}

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection