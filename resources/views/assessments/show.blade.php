@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('body')
<h1>Showing {{ $assessment->topic }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $assessment->topic }} </h2>
        <p>
            <strong>Assesment ID Number:</strong> {{ $assessment->id }}<br>
        </p>
    </div>

   <a href="{{  URL::to('assessments/'.$assessment->id.'/assessment_items') }}">See Assessment_Items</a>

</table>
<!--
<a href="{{ URL::to('assessments/'.$assessment->assessment_id.'/assessment_items/create') }}">Add a Question</a>
-->
</div>

@endsection