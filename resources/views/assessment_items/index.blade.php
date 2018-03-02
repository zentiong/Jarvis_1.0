@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('assessments');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>

@section('body')
    <main class="container-fluid">
        <section class="container-fluid">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">Assessment for: {{ $assessment->topic }}</h1>
                <button>
                    <a href="{{ URL::to('assessments/'.$assessment->id.'/assessment_items/create') }}">Add Assessment Item</a>
                </button>
            </div>

            <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

         
         <br>
         <br>

            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td class="no-stretch">Assessment ID</td>
                    <td class="no-stretch">Assessment Item ID</td>
                    <td>Criteria </td>
                    <td class="no-stretch">Actions</td>
                </tr>
            </thead>

            <tbody>
            @foreach($assessment_items as $key => $value)
                <tr>
                    <td>{{ $value->assessment_id }}</td>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->criteria }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td class="table-actions">

                        <!-- show the assessment (uses the show method found at GET /assessments/{id} -->
                        <!-- -->
                        <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View this item" href="{{ URL::to('assessments/'.$assessment->id.'/assessment_items/'.$value->id) }}">
                            <i class="fa fa-user fa-lg"></i>
                        </a>
                       
                        <!-- edit this assessment (uses the edit method found at GET /assessments/{id}/edit -->
                        <!-- -->
                        <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit this item" href="{{ URL::to('assessments/'.$assessment->id.'/assessment_items/'.$value->id.'/edit') }}">
                            <i class="fa fa-pencil fa-lg"></i>
                        </a>

                        <!-- delete the assessment (uses the destroy method DESTROY /assessments/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                            {{ Form::open(array('url' => 'assessments/'.$assessment->id.'/assessment_items/' . $value->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            <div data-toggle="tooltip" data-placement="bottom" title="Delete this item" >
                                {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                            </div>
                         {{ Form::close() }}
                        
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </section>
    </main>

@endsection