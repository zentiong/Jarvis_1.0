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

			?>

			<p>NORMAL EMPLOYEE LANDING</p>
			<button onclick="update_data(myChart,relevant)">Relevant Skills</button>
            <button onclick="update_data(myChart,alls)">All Skills</button>
            <canvas id="myChart" width=100 height=500></canvas>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
            <script type="text/javascript">

                let relevant = [14,15,67,89,23,56,23,56,78]
                let alls = [12, 19, 3, 5, 2, 3]


                function update_data(chart, data) 
                {
                    chart.data.datasets[0].data = data;
                    chart.update();
                }

                Chart.defaults.global.maintainAspectRatio = false;
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'horizontalBar',
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

    <p>--------------------------------------------------------</p>

<h1> Trainings Recommended to you</h1>
    
    @foreach($trainings_personal as $key => $training)
        <div style="border: 1px solid red;">
            <h6> Training </h6>
            <p>Title: {{$training->title}}</p>
            <p>Date: {{$training->date}}</p>
            <p>Venue: {{$training->venue}}</p>
        @foreach($user_trainings as $key => $user_training)
            @if($user_training->training_id == $training->id) 
                @if($user_training->confirmed == false)
                    {{ Form::open(array('url' => 'confirm')) }}
                    {{ Form::hidden('training_id', $value = $training->id) }}
                    {{ Form::hidden('user_id', $value = Auth::user()->id) }}
                    {{ Form::submit('Confirm Slot', array('class' => 'btn btn-primary create-btn text-center')) }}
                    {{ Form::close() }}
                @else
                    <div style="border: 1px solid blue; width: 100px; height: 30px;">
                        <h6>Going</h6>
                    </div>
                @endif               
            @endif
        @endforeach
        </div>
    @endforeach

<h1> Trainings Not Recommended to you</h1>

    <!-- Different Logic -->

    @foreach($trainings_general as $key => $training)
        {{ $present = false }} 
        <div style="border: 1px solid red;">
            <h6> Training </h6>
            <p>Title: {{$training->title}}</p>
            <p>Date: {{$training->date}}</p>
            <p>Venue: {{$training->venue}}</p>
        @foreach($user_trainings as $key => $user_training)
            @if($user_training->training_id == $training->id) 
                <?php
                    $present = true 
                ?>
            @endif
        @endforeach
        @if($present==false) 
            {{ Form::open(array('url' => 'signup')) }}
            {{ Form::hidden('user_id', $value = Auth::user()->id) }}
            {{ Form::hidden('training_id', $value = $training->id) }}
            {{ Form::submit('Confirm Slot', array('class' => 'btn btn-primary create-btn text-center')) }}
            {{ Form::close() }}
        @else
            @if($user_training->confirmed == true)
                 <div style="border: 1px solid blue; width: 100px; height: 30px;">
                    <h6>Going</h6>
                </div> 
            @endif
        @endif
        </div>
    @endforeach

@endsection