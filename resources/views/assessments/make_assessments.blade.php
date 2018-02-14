@extends('templates.newsletter-master')

@section('body')

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 
$user_id = Auth::user()->id; /* Supervisor */
?>

<!-- 

How is this going to be implemented?

Supervisor sees all employees and assessments?

or Supervisor sees assessments or dropdown skills?

-->

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