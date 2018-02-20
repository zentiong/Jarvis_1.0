@extends('templates.dashboard-master') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
	 $(document).ready(function() {
        var a = document.getElementById('levels');
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
			@if (Session::has('message'))
			    <div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif

			<?php 
			$current_user = Auth::user();
			$current_id = Auth::user()->id;
			$trainings = $current_user->training_session_id
			?>

			<p>NORMAL EMPLOYEE LANDING</p>
			<p>Skills graph here</p>
		</section>
	</main>


@endsection