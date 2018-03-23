@extends('templates.dashboard-master')

@section('body')



<?php 
$user_id = Auth::user()->id; /* Supervisor */
?>

<!-- 

How is this going to be implemented?

Supervisor sees all employees and assessments?

or Supervisor sees assessments or dropdown skills?

-->

 <main class="container create-page">
        <section class="row crud-page-top">
            <h1 class="crud-page-title">Create Assessment</h1>
            <a class="btn crud-main-cta" href="{{ URL::to('see_assessments') }}">See Assessments</a>
        </section>
            <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td  class="no-stretch">Assessment ID</td>
                    <td>Topic</td>
                    <td class="no-stretch">Actions</td>
                </tr>
            </thead>
            <tbody>
            @foreach($assessments as $key => $value)
                <tr>
                
                    <td>{{ $value->id }}</td>
                    <td>

                    @foreach($skills as $key => $skill)
                        @if($skill->id == $value->skill_id)
                            {{$skill->name}}
                        @endif
                    @endforeach
                    </td>
                    
                    <td>
                        <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Make an Assessment" href="{{ URL::to('assessments/' . $value->id . '/make') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>
                       
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

   </main>
@endsection

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