<div class="text-center card-box">
    <h4>{!! tr('posts_last_week') !!}</h4>
    <canvas id="myChart" width="800" height="300" style="background-color: white;"></canvas>
</div>
<script>
    var past_posts = {!! json_encode($stats["last_week_posts"]) !!};
    var data = {
        labels: {!! json_encode(array_keys($stats["last_week_posts"])) !!},
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: past_posts
            }
        ]
    };
    var ctx = document.getElementById("myChart").getContext("2d");
    var myLineChart = new Chart(ctx).Line(data);
</script>