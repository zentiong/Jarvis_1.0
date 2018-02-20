@extends('templates.dashboard-master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('positions');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>

@section('body')

<h1>Information about {{ $position->name }} </h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Name:</strong> {{ $position->name }}<br>
            <strong>Current Employees:</strong><br>
            
        </p>
    </div>

@endsection