@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">{{ $service->name }}</h1>
            </div>
            <a href="{{ URL::to('services') }}" class="btn cancel-btn">Back to All Services</a>
        </section>
        <hr>
    </main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('services');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>