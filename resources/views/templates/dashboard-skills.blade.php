<!-- data collection -->
        <?php
        $qscore_arr_all = array();
        $labels_arr_all = array();
        $assessments_arr = array();
        $score_data_all = array();
        $sk_id_arr = array();
        ?>
        <!-- scores -->
        <?php
        foreach($user_skills as $key => $value)
        {
            if($value->user_id==$current_id)
            {
                $res = ($value->score/$value->max_score)*100;
                array_push($qscore_arr_all,$res);
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
        <!-- assessments -->
        <?php
        foreach($user_assessments as $value)
        {
            if($value->employee_id==$current_id)
            {
                array_push($assessments_arr, $value->rating);
            }
        }

        ?>
        <!-- end assessments -->
        <?php 
        foreach($qscore_arr_all as $value)
        {
                
            if(empty($assessments_arr)==false)
            {
                $comp = (($value*0.5)+(end($assessments_arr)*0.5));
                array_push($score_data_all, $comp);
            }
            else
            {
                $score_data_all = $qscore_arr_all;  
            }
        }            
                    
        ?>
        <!-- end assessments -->
<!-- end of data collection -->
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
                        <button onclick="update_data(myChart,tfive)">Relevant Skills</button>
                        <button onclick="update_data(myChart,qscore_arr_all)">All Skills</button>
                        <canvas id="myChart" width=100 height=500></canvas>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
                        <script type="text/javascript">

                            var qscore_arr_all = <?php echo json_encode($qscore_arr_all)?>;
                            var labels_all = <?php echo json_encode($labels_arr_all)?>;
                            var tfive = [];
                            if(qscore_arr_all.length>5)
                            {
                                tfive = qscore_arr_all.slice(0,5);
                            }
                            else
                            {
                                tfive = qscore_arr_all;
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
                                        label: 'Skill Percentage',
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
                </div>