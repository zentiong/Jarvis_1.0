@extends('templates.dashboard-master') 

<script src="{{ URL::asset('js/dashboard.js') }}"></script>

@section('body')
    <main class="container-fluid">
        <section class="container-fluid">
        
             <?php 
                $current_user = Auth::user();
                $current_id = Auth::user()->id;
                
            ?>
            
            <section class="row personal-details mg-pastel">
                @include('templates.dashboard-profile_photo', ['current_user' => $current_user, 'current_id' => $current_id])
            </section>

            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info" role="alert">
                    <strong>Heads up</strong>
                    {{ Session::get('message') }}
                </div>
            @endif

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

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>First Name</td>
                                        <td>Last Name</td>
                                        <td>Email</td>
                                        <td>Hiring Date</td>
                                        <td>Birth Date</td>
                                        <td>Department</td>
                                        <td>Supervisor</td>
                                        <td>Position</td>
                                        <td>Manager?</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                
                                <tbody>
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
                                
                                @foreach($list as $key => $user)
                                    <tr>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->hiring_date }}</td>
                                        <td>{{ $user->birth_date }}</td>
                                        <td>{{ $user->department }}</td>
                                        @foreach($users_two as $key => $supervisor)
                                            @if($user->supervisor_id == $supervisor->id)
                                                 <td>{{ $supervisor->first_name }} {{ $supervisor->last_name }}</td>
                                            @endif
                                        @endforeach
                                        <td>{{ $user->position }}</td>
                                        @if ($user->manager_check==1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif
                                        <!-- we will also add show, edit, and delete buttons -->
                                        <td class="table-actions">
                                            <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View employee" href="{{ URL::to('users/' . $user->id) }}">
                                                <i class="fa fa-user fa-lg"></i>
                                            </a>
                                        </td>
                                        </tr>                
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <?php
                        //for assessments
                        $init_criteria_label = array();
                        $init_criteria_score = array();
                        $ems_assessment_score = array();
                        $ems_assessment_id = array();
                        $ems_assessment_label = array();


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

                                if(in_array($value->employee_id, $ems_assessment_id)==false)
                                {
                                    array_push($ems_assessment_score, $value->grade);
                                    array_push($ems_assessment_id, $value->employee_id);
                                }
                                else
                                {
                                    $key = $key = array_search($value->employee_id, $ems_assessment_id);
                                    $ems_assessment_score[$key]+=$value->grade;
                                }

                            }
                        }
                        

                        foreach($ems_assessment_id as $key=>$value)
                        {
                            $ref_id = $value;
                            foreach($users as $key=>$value)
                            {
                                if($ref_id==$value->id)
                                {
                                    $res = $value->first_name . " " . $value->last_name;
                                    array_push($ems_assessment_label,$res);
                                }
                            }
                        }

                        ?>

                        <?php
                        //for employee skills
                        $subs_skill_scores = array();
                        $subs_skill_id = array();
                        $subs_skill_labels = array();
                        $subs_emp_id = array();

                        foreach($mg_emps as $key=>$value)
                        {
                            array_push($subs_emp_id, $value->id);
                        }

                        foreach($user_skills as $key=>$value)
                        {
                            if(in_array($value->user_id, $subs_emp_id)==true)
                            {
                                if(in_array($value->skill_id, $subs_skill_id)==false)
                                {
                                    array_push($subs_skill_id, $value->skill_id);
                                    array_push($subs_skill_scores, $value->skill_grade);
                                }
                                else
                                {
                                    $key = $key = array_search($value->skill_id, $subs_skill_id);
                                    $subs_skill_scores[$key]+=$value->skill_grade;
                                }
                            }
                        }

                        foreach($skills as $key=>$value)
                        {
                            $ref_sk_id = $value->id;
                            $name = $value->name;
                            foreach($subs_skill_id as $key=>$value)
                            {
                                if($value==$ref_sk_id)
                                {
                                    array_push($subs_skill_labels, $name);
                                }
                            }
                        }
                        
                        print_r($subs_skill_id);
                        print_r($subs_skill_labels);
                        print_r($subs_skill_scores);

                        ?>




                        <button onclick="update_chart(eum_criteria_chart, 'by_criteria')">By Criteria</button>
                        <button onclick="update_chart(eum_criteria_chart, 'by_employee')">By Employee</button>
                        <h1>Assessment Statistics - Subordinates</h1>
                        <canvas id="eum_criteria_chart" width="100" height="100px"></canvas>
                        <div class="dashboard-content">
                            <h1>Skills Statistics - Subordinates</h1>
                            <canvas id="eum_skills_chart" width="100" height="100px"></canvas>
                            <select id="skills_select" onchange="update_eskills_chart(eum_skills_chart,this)">
                                <option value="" disabled selected>Select your option</option>
                                <option value="all">All Employees</option>
                                @foreach($eum_names as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
                        <script type="text/javascript">

                            var init_criteria_score = <?php echo json_encode($init_criteria_score)?>;
                            var init_criteria_label = <?php echo json_encode($init_criteria_label)?>;
                            var ems_assessment_score = <?php echo json_encode($ems_assessment_score)?>;
                            var ems_assessment_label = <?php echo json_encode($ems_assessment_label)?>;

                            function update_chart(target_chart, filter)
                            {
                                if(filter=="by_criteria")
                                {
                                    target_chart.data.datasets[0].data = init_criteria_score;
                                    target_chart.data.labels = init_criteria_label;
                                    target_chart.update();
                                }
                                else
                                {
                                    target_chart.data.datasets[0].data = ems_assessment_score;
                                    target_chart.data.labels = ems_assessment_label;
                                    target_chart.update(); 
                                }
                            }
                            


                            Chart.defaults.global.maintainAspectRatio = false;
                            var ctx = document.getElementById("eum_criteria_chart").getContext('2d');
                            var eum_criteria_chart = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    labels: init_criteria_label,
                                    datasets: [{
                                        label: 'Total Assessment Scores',
                                        data: init_criteria_score,
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
                        <!--script for employee skills-->
                        <?php
                        for($i=0;$i<sizeof($user_skills);$i++   )
                        {
                            $ref = $user_skills[$i]->skill_id;
                            foreach($skills as $key=>$value)
                            {
                                if($value->id==$ref)
                                {
                                    $user_skills[$i]->skill_id = $value->name;

                                }
                            }
                        }

                        ?>
                        <script type="text/javascript">

                            var subs_skill_scores = <?php echo json_encode($subs_skill_scores)?>;
                            var subs_skill_labels = <?php echo json_encode($subs_skill_labels)?>;
                            var user_skills = <?php echo json_encode($user_skills)?>;
                            

                            function update_eskills_chart(target_chart,filter)
                            {
                                var fvalue = filter.options[filter.selectedIndex].value;
                                var filtered_skill_scores = [];
                                var filtered_skill_ids = [];

                                if(fvalue=="all")
                                {
                                    target_chart.data.datasets[0].data = subs_skill_scores;
                                    target_chart.data.labels = subs_skill_labels;
                                    target_chart.update(); 
                                }
                                else
                                {
                                    for(var i=0;i<user_skills.length;i++)
                                    {
                                        if(user_skills[i].user_id==fvalue)
                                        {
                                            filtered_skill_scores.push(user_skills[i].skill_grade);
                                            filtered_skill_ids.push(user_skills[i].skill_id);
                                        }
                                    }

                                    target_chart.data.datasets[0].data = filtered_skill_scores;
                                    target_chart.data.labels = filtered_skill_ids;
                                    target_chart.update();
                                }


                                 
                                
                            }


                            Chart.defaults.global.maintainAspectRatio = false;
                            var ctx = document.getElementById("eum_skills_chart").getContext('2d');
                            var eum_skills_chart = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    labels: subs_skill_labels,
                                    datasets: [{
                                        label: 'Skill Level',
                                        data: subs_skill_scores,
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
                </div>

            </section>
        
       </section>

    </main>


    
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