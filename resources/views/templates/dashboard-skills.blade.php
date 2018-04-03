<!-- data collection -->
        <?php
        $labels_arr_all = array();
        $score_data_all = array();
        $sk_id_arr = array();
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
        <!-- end of data collection -->

       
            <!-- PERSONAL CONTENT CONTAINER -->
            
                <div class="col-md-7">
                    <h5 class="dashboard-header"><i class="fa fa-bar-chart"></i>Skills</h5>
                    <div class="dashboard-content">
                        <button onclick="update_data(myChart,tfive)">Relevant Skills</button>
                        <button onclick="update_data(myChart,score_data_all)">All Skills</button>
                        <canvas id="myChart" width=100></canvas>
                        <script src="{{asset('js/Chart.bundle.js')}}"></script>
                        <script src="{{asset('js/utils.js')}}"></script>

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
                            var color = Chart.helpers.color;
                            var colorNames = Object.keys(chartColors);
                            var bcolor = [];
                            var bgcolor = [];

                            for(var i=0; i<score_data_all.length; i++){
                                var colorName = colorNames[i % colorNames.length];
                                var dsColor = chartColors[colorName];

                                bgcolor.push(color(dsColor).alpha(0.5).rgbString());
                                bcolor.push(dsColor);
                            }
                            


                            var myChart = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    labels: labels_all,
                                    datasets: [{
                                        label: 'Skill Level by Percentage',
                                        data: score_data_all,
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
                    @include('templates.dashboard-quiz-evaluations')
                </div>