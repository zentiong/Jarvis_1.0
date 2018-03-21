@extends('templates.dashboard-master')

@section('body')
    
    <main class="container create-page">
        <section class="row crud-page-top">
             @if (Session::has('message'))
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif
            <?php 
                $check = $user->profile_photo;
    
                if($check!=null)
                {
                    $pp = asset( 'images/profile_photos/'.$user->profile_photo);
                }
                else 
                {
                    $pp = asset( 'images/profile_photos/default.png');
                }
            ?>
            <h1 class="crud-page-title">Showing employee {{ $user->first_name }} {{ $user->last_name }}</h1>
        </section>
        <section class="container dashboard-container">
            <div class="row dashboard-body">
                <div class="dashboard-content">
                    <h6 class="content-header light">
                        <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Profile picture:</strong></p>
                            <div class="img-circle profile-picture" style="background-image: url('{{ $pp }}')" alt="Your profile picture"></div>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email address:</strong> {{ $user->email }}</p>
                            <p><strong>Hiring Date:</strong> {{ $user->hiring_date }}<br>
                            <strong>Birth Date:</strong> {{ $user->birth_date }}</p>
                            <strong>Department:</strong> {{ $user->department }}<br>
                            <strong>Supervisor ID:</strong> {{ $user->supervisor_id }}<br>
                            <strong>Position:</strong> {{ $user->position }}<br>
                            <strong>Manager?</strong> 
                            @if($user->manager_check==1)
                                Yes
                            @else
                                No
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row dashboard-body">
                <div class="dashboard-content">
                    <h6 class="content-header light">
                        <strong>Statistics</strong>
                    </h6>

                    <!-- data collection -->
                    <?php
                    $qscore_arr_all = array();
                    $labels_arr_all = array();
                    $assessments_arr = array();
                    $score_data_all = array();
                    $sk_id_arr = array();
                    $quiz_weight = 0;
                    $asmnt_weight = 0;
                    ?>

                    <!-- scores -->
                    <?php
                    foreach($user_skills as $key => $value)
                    {
                        if($value->user_id==$user->id)
                        {
                            if($value->q_score!=0 and $value->q_max_score!=0)
                            {
                                $qres = ($value->q_score/$value->q_max_score)*100;
                                array_push($qscore_arr_all,$qres);
                            }
                            else
                            {
                                array_push($qscore_arr_all,0);
                            }

                            if($value->a_score!=0 and $value->a_max_score!=0)
                            {
                                $ares = ($value->a_score/$value->a_max_score)*100;
                                array_push($assessments_arr,$ares);
                            }
                            else
                            {
                                array_push($assessments_arr,0);
                            }

                            $quiz_weight = $value->knowledge_based_weight/100;
                            $asmnt_weight = $value->skills_based_weight/100;
                            array_push($sk_id_arr,$value->skill_id);
                        }
                    }
                    ?>
                    <!-- end scores -->

                    <!-- labels -->

                    <?php
                    foreach($sk_id_arr as $key => $value)
                    {
                        $sk_id = $value;
                        foreach($skills as $key => $value)
                        {
                            if($sk_id==$value->id)
                            {
                                array_push($labels_arr_all,$value->name);
                            }
                        }
                    }

                    ?>
                    <!-- end labels -->

                    <!-- calculations -->
                    <?php 
                    for($i=0;$i<sizeof($qscore_arr_all);$i++)
                    {
                        $comp = (($qscore_arr_all[$i]*$quiz_weight)+($assessments_arr[$i]*$asmnt_weight));
                        array_push($score_data_all, $comp);
                    }            
                    ?>
                    <!-- end calculations -->
                    <!-- end of data collection -->

                   
                        <!-- PERSONAL CONTENT CONTAINER -->
                        <div class="row dashboard-body" id="personal">
                            <div class="col-md-12">
                                <h5 class="dashboard-header">Skills</h5>
                                <div class="dashboard-content">
                                    <button onclick="update_data(myChart,tfive)">Relevant Skills</button>
                                    <button onclick="update_data(myChart,score_data_all)">All Skills</button>
                                    <canvas id="myChart" width=100></canvas>

                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
                                    <script type="text/javascript">

                                        var score_data_all = <?php echo json_encode($score_data_all)?>;
                                        var labels_all = <?php echo json_encode($labels_arr_all)?>;
                                        var tfive = [];
                                        if(score_data_all.length>5)
                                        {
                                            tfive = score_data_all.slice(0,5);
                                        }
                                        else
                                        {
                                            tfive = score_data_all;
                                        }


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
                                                    label: 'Skill Level by Percentage',
                                                    data: score_data_all,
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
                                                    }],
                                                    xAxes: [{
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
                        </div>
                        




                </div>
            </div>
            <div class="row dashboard-body">
                <div class="dashboard-content">
                    <h6 class="content-header light"><b>Trainings recommended to {{ $user->first_name }} {{ $user->last_name }}</b></h6>
                    
                            
                            @foreach($trainings as $key => $training)
                                @if($training->date >= $now) 
                                <div class="trainings-box">
                                <div>
                                    <!-- text -->
                                    <p><b>{{$training->title}}</b></p>
                                    <span>
                                        {{date('h:i', strtotime($training->starting_time))}}
                                    </span>
                                    <span>
                                        - {{date('h:i a', strtotime($training->ending_time))}}</span>
                                    <span>
                                        | {{date('F d', strtotime($training->date))}}
                                    </span>
                                    <p>{{$training->venue}}</p>
                                </div>
                                </div>
                                @endif
                                
                            @endforeach
                      
                </div>
            </div>
        </section>

    </main>








@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('users');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>