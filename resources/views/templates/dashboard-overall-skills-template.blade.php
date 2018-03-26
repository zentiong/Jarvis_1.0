<?php
$cwide_score_data = array();
$cwide_label_data = array();
$cwide_skill_id = array();
$count = 0;

foreach($cwide_skills as $key=>$value)
{
    array_push($cwide_score_data,$value->skill_grade);
    array_push($cwide_skill_id,$value->skill_id);
}


foreach($cwide_skill_id as $key => $value)
{
    $sk_id = $value;
    foreach($skills as $key => $value)
    {
        if($sk_id==$value->id)
        {
            array_push($cwide_label_data,$value->name);
        }
    }

}
?>

<script type="text/javascript">
$(document).ready(function() {
    var score_data_all = <?php echo json_encode($cwide_score_data)?>;
    var labels_all = <?php echo json_encode($cwide_label_data)?>;
    var tfive = [];
    var filter_data = <?php echo json_encode($filter_data)?>;
    var filtered_data = [];
    var filtered_ids = [];
    var filtered_labels = [];
    if(score_data_all.length>5)
    {
        tfive = score_data_all.slice(0,5);
    }
    else
    {
        tfive = score_data_all;
    }
    function update_chart(target_chart, filter)
    {
        for(var i=0;i<filter_data.length;i++)
        {
            if(filter_data[i].department == filter)
            {
                filtered_data.push(filter_data[i].skill_grade);
                filtered_data.push(filter_data[i].skill_id);
            }
        }
        target_chart.data.datasets[0].data = filtered_data;
        target_chart.update(); 
    }





    Chart.defaults.global.maintainAspectRatio = false;
    var ctx = document.getElementById("cwide_skills_chart").getContext('2d');
    var cwide_skills_chart = new Chart(ctx, {
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
});
</script>