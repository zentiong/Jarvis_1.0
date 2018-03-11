@extends('templates.dashboard-master') 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>

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

        if (typeof jQuery == 'undefined') {
            console.log('jQuery is not defined! you poor thing')
        }
        else {
            console.log('jQuery is defined!');
        }

    </script>

@section('body')

    <main class="container-fluid">
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <?php 
            $current_user = Auth::user();
            $current_id = Auth::user()->id;
            $trainings = $current_user->training_session_id
        ?>

        <section class="row personal-details mg-pastel">
            <div class="inner">
                <img class="img-circle profile-picture" src="{{ asset('images/hr-corp/DL.png') }}" alt="Your profile picture">
                <div class="user-details">
                     @auth
                    <h1 class="username-title">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                    <h6>{{ Auth::user()->position }}</h6>
                    <h6>{{ Auth::user()->department }}</h6>
                    <br>
                    <h6>{{ Auth::user()->email }}</h6>
                    @endauth
                </div>
            </div>
            
        </section>

        <section class="container dashboard-container">
            <!-- TAB CONTAINER -->
            <div class="row dashboard-tab-container">
                <button class="btn tablinks" onclick="openTab(event, 'personal')">Personal</button>
                <button class="btn tablinks"  onclick="openTab(event, 'non-personal')">Department-wide</button>
            </div>
            <!-- PERSONAL CONTENT CONTAINER -->
            <div class="row dashboard-body tabcontent" id="personal">
                <div class="col-md-7">
                    <h5 class="dashboard-header">Skills</h5>
                    <div class="dashboard-content">
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
                    </div>
                </div>
                <div class="col-md-5">
                    <h5 class="dashboard-header">Trainings</h5>
                    <div class="dashboard-content">
                        <div class="recommended-wrapper">
                            <h6 class="content-header dark"><b>Recommended Trainings</b></h6>
                            @foreach($trainings_personal as $key => $training)
                                <div class="trainings-box">
                                    <div>
                                        <!-- text -->
                                        <p><b>{{$training->title}}</b></p>
                                        <span>{{date('h:i a', strtotime($training->starting_time))}}</span>
                                        <span>{{
                                            $training->date}}</span>
                                        <p>
                                            {{$training->venue}}
                                        </p>
                                    </div>
                                    <div>
                                        <!-- button -->
                                        @foreach($user_trainings as $key => $user_training)
                                        @if($user_training->training_id == $training->id) 
                                            @if($user_training->confirmed == false)
                                                {{ Form::open(array('url' => 'confirm')) }}
                                                {{ Form::hidden('training_id', $value = $training->id) }}
                                                {{ Form::hidden('user_id', $value = Auth::user()->id) }}
                                                {{ Form::submit('SIGN UP', array('class' => 'btn text-center sign-up-btn light')) }}
                                                {{ Form::close() }}
                                            @else
                                                <span class=" going-state light">&#x2714; I'M GOING</span>
                                            @endif             
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="dashboard-content">
                        <div class="incoming-wrapper">
                            <h6 class="content-header light"><b>Trainings this month</b></h6>
                            @foreach($trainings_general as $key => $training)
                                {{ $present = false }} 
                                <div class="trainings-box">
                                    <div>
                                        <!-- text -->
                                        <p><b>{{$training->title}}</b></p>
                                        <span>
                                            {{date('h:i a', strtotime($training->starting_time))}}
                                        </span>
                                        <span>
                                            {{$training->date}}
                                        </span>
                                        <p>{{$training->venue}}</p>
                                    </div>
                                    <div>
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
                                            {{ Form::submit('SIGN UP', array('class' => 'btn text-center sign-up-btn dark')) }}
                                            {{ Form::close() }}
                                        @else
                                            @if($user_training->confirmed == true)
                                                <span class="going-state dark">
                                                    &#x2714; I'M GOING
                                                </span> 
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- NON-PERSONAL CONTENT CONTAINER -->
            <div class="row dashboard-body tabcontent" id="non-personal">
                <div class="col-md-12">
                    <h5 class="dashboard-header">Department overview</h5>
                    <div class="dashboard-content">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>First Name</td>
                                    <td>Last Name</td>
                                    <td>Email</td>
                                    <td>Hiring Date</td>
                                    <td>Birth Date</td>
                                    <td>Department</td>
                                    <td>Supervisor ID</td>
                                    <td>Position</td>
                                    <td>Manager?</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $value)
                                @if($value->supervisor_id==$current_id)
                                    <tr>
                                        <td>{{ $value->first_name }}</td>
                                        <td>{{ $value->last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->hiring_date }}</td>
                                        <td>{{ $value->birth_date }}</td>
                                        <td>{{ $value->department }}</td>
                                        <td>{{ $value->supervisor_id }}</td>
                                        <td>{{ $value->position }}</td>

                                        @if ($value->manager_check==1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif

                                        <!-- we will also add show, edit, and delete buttons -->
                                        <td class="table-actions">
                                            <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View employee" href="{{ URL::to('users/' . $value->id) }}">
                                                <i class="fa fa-user fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
@endsection