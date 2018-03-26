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