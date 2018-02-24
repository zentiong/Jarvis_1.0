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
			<canvas id="myChart" width=100 height=500></canvas>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
            <script type="text/javascript">

                Chart.defaults.global.maintainAspectRatio = false;
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                        datasets: [{
                            label: 'Relevant Skills',
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

            </script>
		</section>
	</main>


@endsection