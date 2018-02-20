@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')

<h2> Showing assessment_items of this assessment ({{ $assessment->topic }} ) </h2>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

 <a href="{{ URL::to('assessments/'.$assessment->id.'/assessment_items/create') }}" style="float: right;">Add a Assessment Item</a>
 <br>
 <br>

    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Assessment ID</td>
            <td>Assessment Item ID</td>
            <td>Criteria </td>
        </tr>
    </thead>

    <tbody>
    @foreach($assessment_items as $key => $value)
        <tr>
            <td>{{ $value->assessment_id }}</td>
            <td>{{ $value->id }}</td>
            <td>{{ $value->criteria }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the assessment (uses the destroy method DESTROY /assessments/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                    {{ Form::open(array('url' => 'assessments/'.$assessment->id.'/assessment_items/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Remove', array('class' => 'btn btn-warning')) }}
                 {{ Form::close() }}
                <!-- show the assessment (uses the show method found at GET /assessments/{id} -->
                <!-- -->
                <a class="btn btn-small btn-success" href="{{ URL::to('assessments/'.$assessment->id.'/assessment_items/'.$value->id) }}">Show this Assessment Item</a>
               
                <!-- edit this assessment (uses the edit method found at GET /assessments/{id}/edit -->
                <!-- -->
                <a class="btn btn-small btn-info" href="{{ URL::to('assessments/'.$assessment->id.'/assessment_items/'.$value->id.'/edit') }}">Edit this Assessment Item</a>
                
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
   

@endsection