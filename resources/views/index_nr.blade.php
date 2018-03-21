@extends('templates.dashboard-master')  


@section('body')

	<main class="container-fluid">

        <?php 
            $current_user = Auth::user();
            $current_id = Auth::user()->id;
            
        ?>
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        
        <section class="row personal-details nr-pastel">

            @include('templates.dashboard-profile_photo', ['current_user' => $current_user, 'current_id' => $current_id])
        </section>
        <section class="container dashboard-container">
            <div class="row dashboard-body tabcontent" id="personal">
                @include('templates.dashboard-skills')</div>
                @include('templates.dashboard-trainings')
            </div>
                
            <?php 
            $evals_to_take = array(); // user trainings where quiz has already been training
            ?>
        </section>
	</main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    // enables dynamic navbar
    $(document).ready(function() {
        var a = document.getElementById('levels');
        a.classList.toggle("active");
    });
     // enables Bootstrap tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


