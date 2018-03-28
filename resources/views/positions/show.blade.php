@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">Information about position</h1>
                <h5>Showing: {{ $position->name }}</h5>
            </div>
            <a href="{{ URL::to('positions') }}" class="btn cancel-btn">Back to All Positions</a>
        </section>
        <section>
             <div class="jumbotron text-center">
                <p>
                    <strong>Position name:</strong> {{ $position->name }}<br>
                    <strong>Current Employees:</strong><br>
                    @foreach($users as $key=>$user)
                        {{$user->first_name}} {{$user->last_name}}<br>
                    @endforeach
                </p>
            </div>
        </section>
    </main>

   

@endsection

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