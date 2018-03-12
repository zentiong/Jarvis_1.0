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
    
    function openTab(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
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
        ?>

        <p>HR+MANAGER LANDING</p>
        <div class="tab">
          <button class="tablinks" onclick="openTab(event, 'skills')">My Skills</button>
          <button class="tablinks" onclick="openTab(event, 'employees')">Employees Under Me</button>
          <button class="tablinks" onclick="openTab(event, 'trainings')">Trainings</button>
        </div>

<!-- data collection -->
        <!-- scores -->
        @foreach($user_quizzes as $key => $value)
            <?php $u_id=$value->id ?>
            @if($value->user_id==$current_id)
                @foreach($section_attempts as $key => $value)
                    @if($value->user_quiz_id==$u_id)
                         <?php
                         $qscore_arr_all = array();
                         $res = $value->score/$value->max_score;
                         array_push($qscore_arr_all,$res);
                         ?>
                    @endif
                @endforeach
            @endif       
        @endforeach
        <!-- end scores -->
        <!-- labels -->
        @foreach($user_quizzes as $key => $value)
            <?php $u_id=$value->id ?>
            @if($value->user_id==$current_id)
                @foreach($section_attempts as $key => $value)
                    @if($value->user_quiz_id==$u_id)
                    <?php $sc_id = $value->section_id?>
                        @foreach($sections as $key=>$value)
                            @if($sc_id==$value->id)
                            <?php $sk_id = $value->skill_id?>
                                @foreach($skills as $key=>$value)
                                    @if($sk_id==$value->id)
                                        <?php 
                                        $labels_arr_all = array();
                                        array_push($labels_arr_all, $value->name);
                                        ?>
                                    @endif
                                @endforeach
                            @endif 
                        @endforeach
                    @endif
                @endforeach
            @endif       
        @endforeach
        <!-- end labels -->
<!-- end of data collection -->
        <div id="skills" class="tabcontent">
          <button onclick="update_data(myChart,relevant)">Relevant Skills</button>
            <button onclick="update_data(myChart,qscore_arr_all)">All Skills</button>
            <canvas id="myChart" width=100 height=500></canvas>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
            <script type="text/javascript">

                            let relevant = [14,15,67,89,23,56,23,56,78]
                            var qscore_arr_all = <?php echo json_encode($qscore_arr_all)?>;
                            var labels_all = <?php echo json_encode($labels_arr_all)?>;



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
                                    labels: labels_all,
                                    datasets: [{
                                        label: 'Relevant Skills',
                                        data: qscore_arr_all,
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
                                                beginAtZero:false
                                            }
                                        }]
                                    }
                                }
                            });
            </script>
        </div>

        <section id="employees" class="tabcontent container-fluid">
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

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
        </section>
        
        <section id="trainings" class="tabcontent container-fluid">
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Date</td>
                    <td>Description</td>
                    <td>Speaker</td>
                    <td>Venue</td>
                </tr>
            </thead>
            <tbody>
            @foreach($trainings as $key => $value)
                <tr>
                    <td>{{ $value->date }}</td> 
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->speaker }}</td>
                    <td>{{ $value->venue }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td class="table-actions">

                        <!-- show the employee (uses the show method found at GET /employees/{id} -->
                        <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View employee" href="{{ URL::to('users/' . $value->id) }}">
                            <i class="fa fa-user fa-lg"></i>
                        </a>

                        <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                        <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit employee" href="{{ URL::to('users/' . $value->id . '/edit') }}">
                            <i class="fa fa-pencil fa-lg"></i>
                        </a>

                        <!-- delete the employee (uses the destroy method DESTROY /employees/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                        {{ Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        <div data-toggle="tooltip" data-placement="bottom" title="Delete employee" data-animation="true">
                            {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                        </div>
                            
                        {{ Form::close() }}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table> 
        <a href="trainings/create">Add New Training</a>
        </section>

    </main>
@endsection