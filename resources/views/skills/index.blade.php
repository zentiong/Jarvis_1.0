@extends('templates.newsletter-master') 

@section('body')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 
$user_id = Auth::user()->id;
?>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Skill ID</td>
            <td>Skill Name</td>
            <td>Options</td>
        </tr>
    </thead>
    <tbody>
    @foreach($skills as $key => $value)
        <tr>
            

            <td>{{ $value->id }}</td>
            <td>{{ $value->name}}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the quiz (uses the destroy method DESTROY /quizzes/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                    {{ Form::open(array('url' => 'skills/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}
                
                <a class="btn btn-small btn-info" href="{{ URL::to('skills/' . $value->id . '/edit') }}">Edit</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<a href="skills/create">Add Skill</a>


@endsection