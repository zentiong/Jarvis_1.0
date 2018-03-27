@extends('templates.dashboard-master') 

<script src="{{ URL::asset('js/dashboard.js') }}"></script>

@section('body')
    <main class="container-fluid">
        <section class="container-fluid">
        
             <?php 
                $current_user = Auth::user();
                $current_id = Auth::user()->id;
                
            ?>
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            
            <section class="row personal-details mg-pastel">
                @include('templates.dashboard-profile_photo', ['current_user' => $current_user, 'current_id' => $current_id])
            </section>

            <section class="container dashboard-container">
                <!-- TAB CONTAINER -->
                <div class="row dashboard-tab-container">
                    <button class="btn tablinks" onclick="openTab(event, 'personal')">Personal</button>
                    <button class="btn tablinks"  onclick="openTab(event, 'non-personal')">Department-wide</button>
                </div>
                
                <div class="row dashboard-body tabcontent" id="personal">
                    <!-- data collection -->
                    <?php
                    $labels_arr_all = array();
                    $score_data_all = array();
                    $sk_id_arr = array();

                    $dwide_skill_data = array();
                    $dwide_label_data = array();
                    $dwide_sk_id = array();
                    
                    ?>

                    <!-- scores -->
                    <?php
                    foreach($user_skills as $key => $value)
                    {
                        if($value->user_id==$current_id)
                        {
                            array_push($score_data_all,$value->skill_grade);
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


                    <!-- dept wide scores -->
                    <?php
                    $emp_under = array();
                    foreach($users as $key=>$value)
                    {
                        if($value->supervisor_id==$current_user->id)
                        {
                            array_push($emp_under,$value->id);

                        }
                    }
                    foreach($user_skills as $key => $value)
                    {
                        if(in_array($value->user_id, $emp_under))
                        {
                            array_push($dwide_skill_data,$value->skill_grade);
                            array_push($dwide_sk_id,$value->skill_id);
                        }
                    }
                    print_r($emp_under)
                    ?>
                    <!-- end dept wide scores -->

                    <!-- dept wide labels -->

                    <?php
                    foreach($dwide_sk_id as $key => $value)
                    {
                        $ref_id = $value;
                        foreach($skills as $key => $value)
                        {
                            if($ref_id==$value->id)
                            {
                                array_push($dwide_label_data,$value->name);
                            }
                        }
                    }

                    ?>
                    <!-- end labels -->



                    <!-- end of data collection -->

       
            <!-- PERSONAL CONTENT CONTAINER -->
            
                <div class="col-md-7">
                    <h5 class="dashboard-header"><i class="fa fa-bar-chart"></i>Skills</h5>
                    <div class="dashboard-content">
                        <button onclick="update_data(myChart,score_data_all,labels_all)">Personal Skills</button>
                        <button onclick="update_data(myChart,dwide_skill_data,dwide_label_data)">Department Wide Skills</button>
                        <canvas id="myChart" width=100></canvas>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
                        <script type="text/javascript">

                            var score_data_all = <?php echo json_encode($score_data_all)?>;
                            var labels_all = <?php echo json_encode($labels_arr_all)?>;

                            var dwide_skill_data = <?php echo json_encode($dwide_skill_data)?>;
                            var dwide_label_data = <?php echo json_encode($dwide_label_data)?>;

                            function update_data(chart, data, labels) 
                            {
                                chart.data.datasets[0].data = data;
                                chart.data.labels = labels;
                                chart.update();
                            }
                            console.log(dwide_skill_data);


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
                                            'rgba(255, 99, 132, 0.5)',
                                            'rgba(54, 162, 235, 0.5)',
                                            'rgba(255, 206, 86, 0.5)',
                                            'rgba(75, 192, 192, 0.5)',
                                            'rgba(153, 102, 255, 0.5)',
                                            'rgba(255, 159, 64, 0.5)'
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
                    @include('templates.dashboard-quiz-evaluations')
                </div>



                    @include('templates.dashboard-trainings')

                </div>
                
                <!-- NON-PERSONAL CONTENT CONTAINER -->
                <div class="row dashboard-body tabcontent" id="non-personal">
                    <div class="col-md-12">
                        <h5 class="dashboard-header"><i class="fa fa-users"></i>Department overview</h5>
                        <div class="dashboard-content">

                           
                                




                    </div>
                </div>

            </section>
        
       </section>

    </main>

    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Department</td>
            <td>Supervisor ID</td>
            <td>Employee ID</td>
            <td>Skill</td>
            <td>Criteria</td>
            <td>Grade</td>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $key => $grade)
        <tr>
            <td>{{$grade->department}}</td>
            <td>{{$grade->supervisor_id}}</td>
            <td>{{$grade->employee_id}}</td>
            <td>{{$grade->skill}}</td>
            <td>{{$grade->criteria}}</td>
            <td>{{$grade->grade}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>

    <?php

                                    /* 
                                        1) Buffer to Extraction Area
                                        2) Extract
                                        3) Extracted Children to Buffer
                                        4) Parents to List

                                    */

                                    $list = array();
                                    $extraction = array();
                                    $buffer = array();

                                    array_push($buffer, $current_user);

                                    while(!empty($buffer)) {
                                        $extraction = $buffer;
                                        $buffer = array();
                                        foreach ($extraction as $key => $parent) {
                                            if(!in_array($parent, $list))
                                            {
                                                array_push($list, $parent);
                                                $children = $parent->subordinates()->get();
                                                foreach ($children as $key => $child) {
                                                    array_push($buffer, $child);
                                                }
                                                
                                            }
                                        }
                                    }

                                ?>
                                
                        </div>

                        <?php
                        $init_criteria_label = array();
                        $init_criteria_score = array();

                        foreach($grades as $key=>$value)
                        {
                            if($value->supervisor_id==$current_id)
                            {
                                if(in_array($value->criteria, $init_criteria_label)==false)
                                {
                                    array_push($init_criteria_score, $value->grade);
                                    array_push($init_criteria_label, $value->criteria);
                                }
                                else
                                {
                                    $key = $key = array_search($value->criteria, $init_criteria_label);
                                    $init_criteria_score[$key]+=$value->grade;
                                }
                            }
                        }
                        ?>
                        <canvas id="eum_criteria_chart" width="100px" height="100px"></canvas>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
                        <script type="text/javascript">

                            var score_data_all = <?php echo json_encode($init_criteria_score)?>;
                            var labels_all = <?php echo json_encode($init_criteria_label)?>;


                            Chart.defaults.global.maintainAspectRatio = false;
                            var ctx = document.getElementById("eum_criteria_chart").getContext('2d');
                            var eum_criteria_chart = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    labels: labels_all,
                                    datasets: [{
                                        label: 'Skill Level by Percentage',
                                        data: score_data_all,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.5)',
                                            'rgba(54, 162, 235, 0.5)',
                                            'rgba(255, 206, 86, 0.5)',
                                            'rgba(75, 192, 192, 0.5)',
                                            'rgba(153, 102, 255, 0.5)',
                                            'rgba(255, 159, 64, 0.5)'
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

@endsection

<style>
td {
    min-width: 50px;
    border: 1px solid black;
}

</style>

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
</script>