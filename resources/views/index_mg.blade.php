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
       
            <!-- PERSONAL CONTENT CONTAINER -->
            <div class="row dashboard-body tabcontent" id="personal">
                    @include('templates.dashboard-skills')
                    @include('templates.dashboard-trainings')
                </div>
                
                <!-- NON-PERSONAL CONTENT CONTAINER -->
                <div class="row dashboard-body tabcontent" id="non-personal">
                    <div class="col-md-12">
                        <h5 class="dashboard-header">
                            <i class="fa fa-area-chart"></i>
                            Department skills statistics
                        </h5>
                        <button class="btn btn-sm btn-light toggle-card">TOGGLE VISIBILITY</button>
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
                        ?>

                        <div class="dashboard-content">
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
                        <script src="{{asset('js/utils.js')}}"></script>
                        <script src="{{asset('js/Chart.bundle.js')}}"></script>
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

                            var color = Chart.helpers.color;
                            var colorNames = Object.keys(chartColors);
                            var bcolor = [];
                            var bgcolor = [];

                            for(var i=0; i<subs_skill_scores.length; i++){
                                var colorName = colorNames[i];
                                var dsColor = chartColors[colorName];

                                bgcolor.push(color(dsColor).alpha(0.5).rgbString());
                                bcolor.push(dsColor);
                            }
                            

                            var eum_skills_chart = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    labels: subs_skill_labels,
                                    datasets: [{
                                        label: 'Skill Level',
                                        data: subs_skill_scores,
                                        backgroundColor: bgcolor,
                                        borderColor: bcolor,
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
                    <div class="col-md-12">
                        <div class="row dashboard-header">
                            <h5>
                                <i class="fa fa-users"></i>
                                Department employees overview
                            </h5>
                            <a id="users" href="{{ URL::to('make_assessments') }}" class="btn crud-sub-cta">Employee Assessment</a>
                        </div>
                        <button class="btn btn-sm btn-light toggle-card">TOGGLE VISIBILITY</button>
                        <div class="dashboard-content">
                            <table class="table table-hover table-striped table-bordered">
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
                    </div>
                </div>
            </section>
       </section>
    </main>
    
@endsection

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