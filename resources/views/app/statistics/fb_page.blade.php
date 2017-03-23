<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{!! tr('page_info') !!}</h3>
            </div>
            <div class="panel-body">
                <i class="fa fa-eye"></i> {!! tr('page_views_for_the_last_month') !!}
                месец: {!! $stats['page_insights']['page_views_total'] !!}
                <br>
                <i class="fa fa-comments"></i> {!! tr('posts_last_month') !!}
                : {!! $stats['page_insights']['page_stories'] !!}
                <br>
                <i class="fa fa-comments"></i> {!! tr('post_likes_today') !!}:
                <img src="https://www.facebook.com/rsrc.php/v2/y1/r/ocUOJvkTS_o.png" width="20"
                     alt="">{!! $stats['page_insights']['page_actions_post_reactions_total']["like"] !!}
                <img src="https://www.facebook.com/rsrc.php/v2/yr/r/aQYCdQ90YRq.png" width="20"
                     alt="">{!! $stats['page_insights']['page_actions_post_reactions_total']["love"] !!}
                <img src="https://www.facebook.com/rsrc.php/v2/yd/r/0Cc-BsD-oR7.png" width="20"
                     alt="">{!! $stats['page_insights']['page_actions_post_reactions_total']["haha"] !!}
                <img src="https://www.facebook.com/rsrc.php/v2/yn/r/l7Ks8Ba69nT.png" width="20"
                     alt="">{!! $stats['page_insights']['page_actions_post_reactions_total']["sorry"] !!}
                <img src="https://www.facebook.com/rsrc.php/v2/yX/r/Cmroz4Dk8k0.png" width="20"
                     alt="">{!! $stats['page_insights']['page_actions_post_reactions_total']["wow"] !!}
                <img src="https://www.facebook.com/rsrc.php/v2/ym/r/9alAmm04oYA.png" width="20"
                     alt="">{!! $stats['page_insights']['page_actions_post_reactions_total']["anger"] !!}
                <br> <i class="fa fa-thumbs-up"></i> {!! tr('page_likes') !!}
                : {!! $stats['page_insights']['page_fans'] !!}
                <br>
            </div>
        </div>
    </div>
</div>
<div class="text-center card-box">
    <h4>{!! tr('posts_last_week') !!}</h4>
    <canvas id="myChart" width="600" height="300" style="background-color: white;"></canvas>
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