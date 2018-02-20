@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 
$user_id = Auth::user()->id; /* Supervisor */
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
                 <a class="btn btn-small btn-info" href="{{ URL::to('assessments/' . $value->id . '/take') }}">Make an Assessment</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection