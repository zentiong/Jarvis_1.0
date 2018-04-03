@extends('templates.dashboard-master') 

@section('body')

    <main class="container-fluid">
        <section class="container-fluid">

        <?php 
            $current_user = Auth::user();
            $current_id = Auth::user()->id;
            
        ?>
        
        <section class="row personal-details hr-pastel">
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

            <div class="row dashboard-tab-container">
              <button class="btn tablinks" onclick="openTab(event, 'personal')">Personal</button>
              <button class="btn tablinks" onclick="openTab(event, 'department-wide')">Department-Wide</button>
              <button class="btn tablinks" onclick="openTab(event, 'non-personal')">Company-Wide</button>
            </div>


            <div class="row dashboard-body tabcontent" id="personal">
            @include('templates.dashboard-skills', ['user_skills' => $user_skills])
                
            @include('templates.dashboard-trainings')
            </div>

            <!-- DEPARTMENT-WIDE CONTENT CONTAINER -->
            <div class="row dashboard-body tabcontent" id="department-wide">
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
                                    5) Repeat

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
                            @foreach($list as $key => $value)
                                @if($value->supervisor_id==$current_id)
                                    <tr>
                                        <td>{{ $value->first_name }}</td>
                                        <td>{{ $value->last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->hiring_date }}</td>
                                        <td>{{ $value->birth_date }}</td>
                                        <td>{{ $value->department }}</td>
                                        @foreach($users_two as $key => $supervisor)
                                            @if($value->supervisor_id == $supervisor->id)
                                                 <td>{{ $supervisor->first_name }} {{ $supervisor->last_name }}</td>
                                            @endif
                                        @endforeach
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

            <!-- TRAININGS CONTENT CONTAINER -->
            <div class="row dashboard-body tabcontent" id="non-personal">
                    <div class="col-md-6">
                        <h5 class="dashboard-header">
                            <i class="fa fa-area-chart"></i>
                            Overall skills statistics
                        </h5>
                        <button class="btn btn-sm btn-light toggle-card">TOGGLE VISIBILITY</button>
                        <div class="dashboard-content">
                            <canvas id="cw_overall_skills"></canvas>
                            <select id="chartCWSkills">
                                <option value="" disabled selected>Select your option</option>
                                <option value="{{$result5[0][0]}}|{{$result5[0][1]}}" id="defaultCW" hidden></option>
                            @foreach($result5 as $key => $value)
                                <option value="{{$value[0]}}|{{$value[1]}}">{{$value[0]}}</option>
                            @endforeach
                            </select>
                        </div>

                        <h5 class="dashboard-header">
                            <i class="fa fa-font"></i>
                            Overall quiz statistics
                        </h5>
                        <button class="btn btn-sm btn-light toggle-card">TOGGLE VISIBILITY</button>
                        <div class="dashboard-content">
                            <canvas id="cw_overall_quiz" width=100></canvas>
                        </div>
                        
                        <h5 class="dashboard-header">
                            <i class="fa fa-book"></i>
                            Overall assessment statistics
                        </h5>
                        <button class="btn btn-sm btn-light toggle-card">TOGGLE VISIBILITY</button>
                        <div class="dashboard-content">
                            <canvas id="cw_overall_assessment"></canvas>
                        </div>

                        <h5 class="dashboard-header">
                            <i class="fa fa-columns"></i>
                            Assessment statistics Per criteria
                        </h5>
                        <button class="btn btn-sm btn-light toggle-card">TOGGLE VISIBILITY</button>
                        <div class="dashboard-content">
                            <canvas id="assessment_criteria"></canvas>
                            <select id="chartACriteria">
                                <option value="" disabled selected>Select your option</option>
                            @foreach($result4 as $key => $value)
                                <option value="{{$value[0]}}|{{$value[1]}}">{{$value[0]}}</option>
                            @endforeach
                            </select>
                        </div>
                        
                    </div>

                    <div class="col-md-6">
                        <div class="row dashboard-header">
                            <h5>
                                <i class="fa fa-line-chart"></i>
                                Overall training details
                            </h5>
                            <a class="crud-sub-cta" href="trainings/create">&#43; Add Training</a>
                        </div>
                        <button class="btn btn-sm btn-light toggle-card">TOGGLE VISIBILITY</button>
                        <div class="dashboard-content">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>Date</td>
                                        <td>Title</td>
                                        <td>Speaker</td>
                                        <td>Venue</td>
                                        <td class="no-stretch">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($trainings as $key => $value)
                                    <tr>
                                        <td>{{ $value->date }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->speaker }}</td>
                                        <td>{{ $value->venue }}</td>

                                        <!-- we will also add show, edit, and delete buttons -->
                                        <td class="table-actions no-stretch">

                                            <!-- show the employee (uses the show method found at GET /employees/{id} -->
                                            <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View training" href="{{ URL::to('trainings/' . $value->id) }}">
                                                <i class="fa fa-user fa-lg"></i>
                                            </a>

                                            <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                                            <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit training" href="{{ URL::to('trainings/' . $value->id . '/edit') }}">
                                                 <i class="fa fa-pencil fa-lg"></i>
                                            </a>

                                            <!-- delete the employee (uses the destroy method DESTROY /employees/{id} -->
                                            <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                {{ Form::open(array('url' => 'trainings/' . $value->id, 'class' => 'pull-right')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <div data-toggle="tooltip" data-placement="bottom" title="Delete training" data-animation="true">
                                                    {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                                                </div>

                                             {{ Form::close() }}
                                            

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>   
                        </div>

                        <h5 class="dashboard-header">
                            <i class="fa fa-list-alt"></i>
                            Training attendance statistics
                        </h5>
                        <button class="btn btn-sm btn-light toggle-card">TOGGLE VISIBILITY</button>
                        <div class="dashboard-content">
                            <canvas id="training_attendance" width=100></canvas>
                            <div class="row">
                                <button id="addData">Add Data Point</button>&nbsp;
                                <select id="chartType">
                                    <option value="" disabled selected>Select your option</option>
                                @foreach($result as $key => $value)
                                    <option value="{{$value[1]}}|{{$value[0]}}">{{$value[0]}}</option>
                                @endforeach
                                </select>&nbsp;
                                <button id="clear">Clear Graph</button>
                            </div>
                        </div>

                        <h5 class="dashboard-header">
                            <i class="fa fa-check-circle-o"></i>
                            Training evaluations statistics
                        </h5>
                        <button class="btn btn-sm btn-light toggle-card">TOGGLE VISIBILITY</button>
                        <div class="dashboard-content">
                            <canvas id="training_evals"></canvas>
                            <select id="chartEvals">
                                <option value="" disabled selected>Select your option</option>
                            @foreach($result2 as $key => $value)
                                <option value="{{$value[1]}}|{{$value[0]}}|{{$value[2]}}">{{$value[0]}}</option>
                            @endforeach
                            </select>
                        </div>

                        <h5 class="dashboard-header">
                            <i class="fa fa-paperclip"></i>
                            Trainings quiz statistics
                        </h5>
                        <button class="btn btn-sm btn-light toggle-card">TOGGLE VISIBILITY</button>
                        <div class="dashboard-content">
                            <canvas id="training_quiz"></canvas>
                            <select id="chartTQuiz">
                                <option value="" disabled selected>Select your option</option>
                                @foreach($result3 as $key => $value)
                                    <option value="{{$value[0]}}|{{$value[1]}}|{{$value[2]}}">{{$value[0]}}</option>
                                @endforeach
                            </select>
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="{{asset('js/Chart.bundle.js')}}"></script>
    <script src="{{asset('js/utils.js')}}"></script>

    <!-- training attendance stats-->
    <script type="text/javascript">
    $(document).ready(function() 
        {
        var ctx = document.getElementById("training_attendance").getContext('2d');
        var color = Chart.helpers.color;
        var horizontalBardata = {
            labels: [],
            datasets: []
        }
            
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: horizontalBardata,
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
        
        var colorNames = Object.keys(chartColors);
        var numData = 0;
        var datasetName = "";

        document.getElementById('addData').addEventListener('click', function() {
            var colorName = colorNames[horizontalBardata.datasets.length % colorNames.length];
            var dsColor = chartColors[colorName];
            var newDataset = {
                label: datasetName,
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                data: []
            }
            
            newDataset.data.push(numData);

            horizontalBardata.datasets.push(newDataset);
            myChart.update();
        });

        document.getElementById('chartType').addEventListener('change', function(){
            var res = $("#chartType").val().split("|");

            numData = res[0];
            datasetName = res[1];

        });

        document.getElementById('clear').addEventListener('click', function(){
            horizontalBardata.datasets =[];
            myChart.update();
        });

    });
    </script>

    <!-- script for training evals -->

    <script type="text/javascript">
    $(document).ready(function() 
     {
        var ctx = document.getElementById("training_evals").getContext('2d');
        var horizontalBardata = {
            labels: [],
            datasets: []
        }
        var color = Chart.helpers.color;
       
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: horizontalBardata,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }],
                     xAxes: [{
                        ticks: {
                            min: 0,
                            max: 5
                        }
                    }]
                }
            }
        });
               
        var colorNames = Object.keys(chartColors);
        var numData = 0;
        var numData2= 0;
        var datasetName = "";


        document.getElementById('chartEvals').addEventListener('change', function(){
            var res = $("#chartEvals").val().split("|");
            numData = parseFloat(res[0]);
            numData2 = parseFloat(res[2]);
            datasetName = res[1];

            var newDataset = {
                label: "Training Rating",
                backgroundColor: 'rgba(255, 99, 132, 0.5)',    
                borderColor: 'rgba(255, 99, 132, 1)',
                data: []
            }

            newDataset.data.push(numData);
            horizontalBardata.datasets[0] =newDataset;

            var newDataset2 = {
                label: "Speaker Rating",
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                data: []

            }
            
            newDataset2.data.push(numData2);

            horizontalBardata.labels[0] = datasetName;
            horizontalBardata.datasets[1] = newDataset2;
            myChart.update();
        });     
       
    });
    </script>

<!-- script for Training Quiz Stats -->
<script type="text/javascript">
$(document).ready(function() 
 {

    var ctx = document.getElementById("training_quiz").getContext('2d');
    var horizontalBardata = {
        labels: [],
        datasets: []
    }
    var numData = 0;
    
    
    

    var color = Chart.helpers.color;
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: horizontalBardata,
        options: {
            title: {
                display: true,
                text: []
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }],
                 xAxes: [{
                    ticks: {
                       min: 0,
                       max: 100,
                       callback: function(value) {
                           return value + "%"
                            }
                       },
                   scaleLabel: {
                       display: true,
                       labelString: "Percentage"
                   }                    
                }]
            }
        }
    });
   

        
    var colorNames = Object.keys(chartColors);

    document.getElementById('chartTQuiz').addEventListener('change', function(){
        var temp = [];
             
        var res = $("#chartTQuiz").val().split("|");
        
        var datasetName = [];
        var input = res[2];   
        myChart.options.title.text = res[0];
        var segmented = input.split(":");
        var z = 0;

        for(var i=0; i<(parseInt(segmented.length/3)); i++){
            var colorName = colorNames[temp.length % colorNames.length];
            var dsColor = chartColors[colorName];  
            datasetName = segmented[z];
            var percentage = parseFloat(segmented[z+1]/segmented[z+2])*100;
            var newDataset = {
                label: [datasetName],
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                data: []
            }

            newDataset.data.push(percentage);
            temp.push(newDataset);

            z = z +3;

        }
        horizontalBardata.datasets = temp;
        
        myChart.update();
    });     

});
</script>

<!-- script for Assessment Criteria Stats -->
<script type="text/javascript">
$(document).ready(function() 
 {
    var ctx = document.getElementById("assessment_criteria").getContext('2d');
    var horizontalBardata = {
        labels: [],
        datasets: []
    }
    
    var color = Chart.helpers.color;
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: horizontalBardata,
        options: {
            title: {
                display: true,
                text: []
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }],
                 xAxes: [{
                    ticks: {
                       min: 0,
                       max: 100,
                       callback: function(value) {
                           return value + "%"
                            }
                       },
                   scaleLabel: {
                       display: true,
                       labelString: "Percentage"
                   }                
                }]
            }
        }
    });
   

        
    var colorNames = Object.keys(chartColors);

    document.getElementById('chartACriteria').addEventListener('change', function(){
        var temp = [];
             
        var res = $("#chartACriteria").val().split("|");
        
        var datasetName = [];
        var input = res[1];   
        myChart.options.title.text = res[0];
        var segmented = input.split(":");
        var z = 0;

        for(var i=0; i<(parseInt(segmented.length/2)); i++){
            var colorName = colorNames[temp.length % colorNames.length];
            var dsColor = chartColors[colorName];  
            datasetName = segmented[z];
            
            var newDataset = {
                label: [datasetName],
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                data: []
            }

            newDataset.data.push(100*parseFloat(segmented[z+1])/5);
            temp.push(newDataset);

            z = z +2;

        }
        horizontalBardata.datasets = temp;
        
        myChart.update();
    });     

});
</script>

<!-- script for Overall skill Stats -->
<script type="text/javascript">
$(document).ready(function() 
 {
    var ctx = document.getElementById("cw_overall_skills").getContext('2d');
    var color = Chart.helpers.color;
    var colorNames = Object.keys(chartColors);
    var defaultCW = $("#defaultCW").val().split("|");


    var seg = defaultCW[1].split(':');
    var counter = 0;
    var temp2 =[];

    for(var i=0; i<(parseInt(seg.length/2)); i++){
            var colorName = colorNames[temp2.length % colorNames.length];
            var dsColor = chartColors[colorName];  
            var datasetName = seg[counter];
            
            var newDataset = {
                label: [datasetName],
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                data: []
            }

            newDataset.data.push(seg[counter+1]);
            temp2.push(newDataset);

            counter= counter + 2;

        }
        
    
    var horizontalBardata = {
        labels: [],
        datasets: temp2
    }
    

    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: horizontalBardata,
        options: {
            title: {
                display: true,
                text: defaultCW[0]
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }],
                 xAxes: [{
                    ticks: {
                       min: 0,
                       max: 100,
                       callback: function(value) {
                           return value + "%"
                            }
                       },
                   scaleLabel: {
                       display: true,
                       labelString: "Percentage"
                   }               
                }]
            }
        }
    });
   

        
    

    document.getElementById('chartCWSkills').addEventListener('change', function(){
        var temp = [];
             
        var res = $("#chartCWSkills").val().split("|");
        
        var datasetName = [];
        var input = res[1];   
        myChart.options.title.text = res[0];
        var segmented = input.split(":");
        var z = 0;

        for(var i=0; i<(parseInt(segmented.length/2)); i++){
            var colorName = colorNames[temp.length % colorNames.length];
            var dsColor = chartColors[colorName];  
            datasetName = segmented[z];
            
            var newDataset = {
                label: [datasetName],
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                data: []
            }

            newDataset.data.push(segmented[z+1]);
            temp.push(newDataset);

            z = z +2;

        }
        horizontalBardata.datasets = temp;
        
        myChart.update();
    });     

});
</script>

<!-- script for Overall assessment Stats -->
<script type="text/javascript">
$(document).ready(function() 
 {
    var ctx = document.getElementById("cw_overall_assessment").getContext('2d');
    var result6 = <?php echo json_encode($result6)?>;
    var temp = [];
    var color = Chart.helpers.color;
    var colorNames = Object.keys(chartColors);
    var horizontalBardata = {
        labels: [],
        datasets: []
    }

    for (var i=0; i<result6.length; i++){
        var colorName = colorNames[temp.length % colorNames.length];
        var dsColor = chartColors[colorName];  
        
        
        var newDataset = {
            label: [result6[i].name],
            backgroundColor: color(dsColor).alpha(0.5).rgbString(),
            borderColor: dsColor,
            data: []
        }

        newDataset.data.push(parseFloat(result6[i].rating)*100);
        temp.push(newDataset);
    }
 
    horizontalBardata.datasets = temp;   

    
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: horizontalBardata,
        options: {
            title: {
                display: true,
                text: 'Assessment Ratings'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }],
                 xAxes: [{
                    ticks: {
                       min: 0,
                       max: 100,
                       callback: function(value) {
                           return value + "%"
                            }
                       },
                   scaleLabel: {
                       display: true,
                       labelString: "Percentage"
                   }               
                }]
            }
        }
    });
    

});
</script>

<!-- Overall quiz stats -->
<script type="text/javascript">
$(document).ready(function() 
 {
    var ctx = document.getElementById("cw_overall_quiz").getContext('2d');
    var result7 = <?php echo json_encode($result7)?>;
    var temp = [];
    var color = Chart.helpers.color;
    var colorNames = Object.keys(chartColors);
    var horizontalBardata = {
        labels: [],
        datasets: []
    }

    for (var i=0; i<result7.length; i++){
        var colorName = colorNames[temp.length % colorNames.length];
        var dsColor = chartColors[colorName];  
        
        
        var newDataset = {
            label: [result7[i].name],
            backgroundColor: color(dsColor).alpha(0.5).rgbString(),
            borderColor: dsColor,
            data: []
        }

        newDataset.data.push(parseFloat(result7[i].rating)*100);
        temp.push(newDataset);
    }
 
    horizontalBardata.datasets = temp;   

    
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: horizontalBardata,
        options: {
            title: {
                display: true,
                text: 'Assessment Ratings'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }],
                 xAxes: [{
                    ticks: {
                       min: 0,
                       max: 100,
                       callback: function(value) {
                           return value + "%"
                            }
                       },
                   scaleLabel: {
                       display: true,
                       labelString: "Percentage"
                   }               
                }]
            }
        }
    });
    

});
</script>
