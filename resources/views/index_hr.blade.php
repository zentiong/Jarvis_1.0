@extends('templates.dashboard-master') 

@section('body')
    <main>
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
                <!-- TAB CONTAINER -->
                <div class="row dashboard-tab-container">
                    <button class="btn tablinks" onclick="openTab(event, 'personal')">Personal</button>
                    <button class="btn tablinks"  onclick="openTab(event, 'non-personal')">Company-wide</button>
                </div>

                <!-- PERSONAL CONTENT CONTAINER -->
                <div class="row dashboard-body tabcontent" id="personal">
                    @include('templates.dashboard-skills')
                    @include('templates.dashboard-trainings')
                </div>
                
                <!-- NON-PERSONAL CONTENT CONTAINER -->
                <div class="row dashboard-body tabcontent" id="non-personal">
                    <div class="col-md-6">
                        <h5 class="dashboard-header">
                            <i class="fa fa-area-chart"></i>
                            Overall skills statistics
                        </h5>
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
                        <div class="dashboard-content">
                            <!-- data collection -->
                            <?php
                            $cwide_quiz_data = array();
                            $cwide_quiz_labels = array();
                            $cwide_quiz_id = array();
                            ?>


                            <!-- scores -->
                            <?php

                                foreach($user_skills as $key=>$value)
                                {
                                    if($value->q_max_score==0)
                                    {
                                        $quiz_score=0;
                                    }
                                    else
                                    {
                                        $quiz_score = ($value->q_score/$value->q_max_score)*$value->knowledge_based_weight;
                                    }
                                    if(in_array($value->skill_id, $cwide_quiz_id)==false)
                                    {
                                        array_push($cwide_quiz_data, $quiz_score);
                                        array_push($cwide_quiz_id, $value->skill_id);
                                        
                                    }
                                    else
                                    {
                                        $key = $key = array_search($value->skill_id, $cwide_quiz_id);
                                        $cwide_quiz_data[$key]+=$quiz_score;
                                    }
                                }
     
                            ?>
                            <!-- end scores -->

                            <!-- labels -->

                            <?php
                            foreach($cwide_quiz_id as $key => $value)
                            {
                                $sk_id = $value;
                                foreach($skills as $key => $value)
                                {
                                    if($sk_id==$value->id)
                                    {
                                        array_push($cwide_quiz_labels,$value->name);
                                    }
                                }
                            }
                            

                            ?>
                            <!-- end labels -->
                            <!-- end of data collection -->
                            <canvas id="cwide_quiz_chart" width=100></canvas>
                        </div>
                        
                        <h5 class="dashboard-header">
                            <i class="fa fa-book"></i>
                            Overall assessment statistics
                        </h5>
                        <div class="dashboard-content">
                            <canvas id="cw_overall_assessment"></canvas>
                        </div>

                        <h5 class="dashboard-header">
                            <i class="fa fa-columns"></i>
                            Assessment Statistics Per Criteria
                        </h5>
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
                                Training Details
                            </h5>
                            <a class="crud-sub-cta" href="trainings/create">&#43; Add Training</a>
                        </div>
                        
                        <div class="dashboard-content">
                            <table class="table table-striped table-bordered">
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
                            Training Evaluations Statistics
                        </h5>
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

            <?php 
            $evals_to_take = array(); // user trainings where quiz has already been training
            ?>
            

           
            
            <!--@foreach($evals_to_take as $key => $eval)
                @if($eval->evaluation==null)
                {{ Form::open(array('url' => 'evaluate')) }}
                @foreach($trainings_taken as $key => $training)
                    @if($training->id == $eval->training_id)
                        {{$training->title}}
                    @endif
                @endforeach            
                {{ Form::hidden('training_id', $value = $eval->training_id) }}
                {{ Form::submit('Provide Feedback', array('class' => 'btn btn-primary create-btn text-center')) }}
                {{ Form::close() }}
                @endif
            @endforeach-->
                </section>

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

    <!-- script for overall quiz-->
    <script type="text/javascript">
        $(document).ready(function() 
        {

            var score_data_all = <?php echo json_encode($cwide_quiz_data)?>;
            var labels_all = <?php echo json_encode($cwide_quiz_labels)?>;
            var tfive = [];
            if(score_data_all.length>5)
            {
                tfive = score_data_all.slice(0,5);
            }
            else
            {
                tfive = score_data_all;
            }


            Chart.defaults.global.maintainAspectRatio = false;
            var ctx = document.getElementById("cwide_quiz_chart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: labels_all,
                    datasets: [{
                        label: 'Quiz Score Total',
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
            });
    </script>


        
    <script src="{{asset('js/Chart.bundle.js')}}"></script>
    <script src="{{asset('js/utils.js')}}"></script>
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