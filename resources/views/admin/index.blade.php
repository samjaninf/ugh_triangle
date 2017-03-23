@extends('admin.layout.main')

@section('title')
    {!! tr("dashboard") !!}
@stop

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">{!! tr("dashboard") !!} </h4>

            <p class="text-muted page-title-alt">{!! tr("welcome_to_the_admin_panel") !!} !</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-account-child text-primary"></i>

                <h2 class="m-0 text-dark counter font-600">{!! \App\Profile::count() !!}</h2>

                <div class="text-muted m-t-5">{!! tr("connected_profiles") !!}</div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-question-answer text-pink"></i>

                <h2 class="m-0 text-dark counter font-600">{!! \App\Post::where('published',1)->count() !!}</h2>

                <div class="text-muted m-t-5">{!! tr("posts") !!}</div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md  md-question-answer text-custom"></i>

                <h2 class="m-0 text-dark counter font-600">{!! \App\Post::where('published',0)->count() !!}</h2>

                <div class="text-muted m-t-5">{!! tr("scheduled_posts") !!}</div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-account-child text-info"></i>

                <h2 class="m-0 text-dark counter font-600">{!! \App\User::count() !!}</h2>

                <div class="text-muted m-t-5">{!! tr("users") !!}</div>
            </div>
        </div>

    </div>





    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="text-dark header-title m-t-0">{!! trans('messages.posts_last_week') !!}</h4>

                <div class="row">
                    <div class="col-md-8">
                        <div class="text-center">
                        </div>

                        <div id="morris-area-with-dotted" style="height: 300px;"></div>

                    </div>


                    <div class="col-md-4">
                        <h4 class="text-dark header-title m-t-0"></h4>

                        <p class="font-600">Facebook <span class="text-primary pull-right">{!! round($profiles["fb"]) !!}
                                %</span></p>

                        <div class="progress m-b-30">
                            <div class="progress-bar progress-bar-primary progress-animated wow animated"
                                 role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                 style="width: {!! round($profiles["fb"]) !!}%">
                            </div><!-- /.progress-bar .progress-bar-danger -->
                        </div><!-- /.progress .no-rounded -->

                        <p class="font-600">Twitter <span class="text-pink pull-right">{!! round($profiles["twitter"]) !!}
                                %</span></p>

                        <div class="progress m-b-30">
                            <div class="progress-bar progress-bar-pink progress-animated wow animated"
                                 role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                 style="width: {!! round($profiles["twitter"]) !!}%">
                            </div><!-- /.progress-bar .progress-bar-pink -->
                        </div><!-- /.progress .no-rounded -->

                        <p class="font-600">LinkedIn <span class="text-info pull-right">{!! round($profiles["linkedin"]) !!}
                                %</span></p>

                        <div class="progress m-b-30">
                            <div class="progress-bar progress-bar-info progress-animated wow animated"
                                 role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                 style="width: {!! round($profiles["linkedin"]) !!}%">
                            </div><!-- /.progress-bar .progress-bar-info -->
                        </div><!-- /.progress .no-rounded -->
                    </div>


                </div>

                <!-- end row -->

            </div>

        </div>


    </div>
    <!-- end row -->

@stop

@section('js')

    <script src="{!!url('t_assets')!!}/plugins/morris/morris.min.js"></script>
    <script src="{!!url('t_assets')!!}/plugins/raphael/raphael-min.js"></script>
    <script>

        /**
         * Theme: Ubold Admin Template
         * Author: Coderthemes
         * Dashboard 2
         */

        !function ($) {
            "use strict";

            var Dashboard2 = function () {
                this.$realData = []
            };

            //creates area chart with dotted
            Dashboard2.prototype.createAreaChartDotted = function (element, pointSize, lineWidth, data, xkey, ykeys, labels, Pfillcolor, Pstockcolor, lineColors) {
                Morris.Area({
                    element: element,
                    pointSize: 0,
                    lineWidth: 0,
                    data: data,
                    xkey: xkey,
                    ykeys: ykeys,
                    labels: labels,
                    hideHover: 'auto',
                    pointFillColors: Pfillcolor,
                    pointStrokeColors: Pstockcolor,
                    resize: true,
                    gridLineColor: '#eef0f2',
                    lineColors: lineColors
                });

            },
                    Dashboard2.prototype.init = function () {

                        //creating area chart
                        var $areaDotData = [
                                @foreach($last_week_posts as $post)
                            {
                                y: '{!! $post['date'] !!}', a: {!! $post['posts'] !!}

                            },
                            @endforeach
                        ];
                        this.createAreaChartDotted('morris-area-with-dotted', 0, 0, $areaDotData, 'y', ['a'], ['Posts Count'], ['#ffffff'], ['#999999'], ['#36404a']);

                    },
                    //init
                    $.Dashboard2 = new Dashboard2, $.Dashboard2.Constructor = Dashboard2
        }(window.jQuery),

//initializing
                function ($) {
                    "use strict";
                    $.Dashboard2.init();
                }(window.jQuery);
    </script>
@stop