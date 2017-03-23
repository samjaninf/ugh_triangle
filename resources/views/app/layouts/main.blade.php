<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{!!url('/ ')!!}/favicon.ico"/>
    <title>@yield('title') | {!! site_option("site_title")!!}</title>
    <link href="{!!url('t_assets')!!}/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('t_assets')!!}/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('t_assets')!!}/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('t_assets')!!}/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('t_assets')!!}/css/pages.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('t_assets')!!}/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('assets/sweetalerts')!!}/sweetalert.css" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{!!url('t_assets')!!}/js/modernizr.min.js"></script>
    @yield('css')
</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="{!! url('app') !!}" class="logo"><i
                            class="icon-envelope-open icon-c-logo"></i><span>{!! site_option("site_title")!!}</span></a>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button class="button-menu-mobile open-left">
                            <i class="ion-navicon"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>

                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="dropdown hidden-xs">
                            <a href="#" data-target="#" class="dropdown-toggle nots-toggle waves-effect waves-light"
                               data-toggle="dropdown" aria-expanded="true">
                                <i class="icon-bell"></i> <span class="nots_count badge badge-xs badge-danger"
                                >{!! $notificationsCount!!}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg">
                                <li class="notifi-title"><span class="label label-default pull-right"><span
                                                class="nots_count">
                                            {!! $notificationsCount!!}
                                        </span> {!! tr("new") !!}</span>{!! tr("notifications") !!}
                                </li>
                                <li class="list-group nicescroll notification-list" tabindex="5000"
                                    style="overflow: hidden; outline: none;" id="nots_area">
                                    <!-- list item-->

                                </li>
                                <li>
                                    <a href="{!! route('app.notification.index') !!}"
                                       class="list-group-item text-right">
                                        <small class="font-600">{!! tr("all_notifications") !!}</small>
                                    </a>
                                </li>
                                <div id="ascrail2000" class="nicescroll-rails"
                                     style="width: 8px; z-index: 1000; cursor: default; position: absolute; top: 0px; left: -8px; height: 0px; display: none;">
                                    <div style="position: relative; top: 0px; float: right; width: 6px; height: 0px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(152, 166, 173); background-clip: padding-box;"></div>
                                </div>
                                <div id="ascrail2000-hr" class="nicescroll-rails"
                                     style="height: 8px; z-index: 1000; top: -8px; left: 0px; position: absolute; cursor: default; display: none;">
                                    <div style="position: relative; top: 0px; height: 6px; width: 0px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(152, 166, 173); background-clip: padding-box;"></div>
                                </div>
                            </ul>
                        </li>
                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i
                                        class="icon-size-fullscreen"></i></a>
                        </li>

                        <li class="dropdown">
                            <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img
                                        src="{!! $user->getAvatar() !!}" alt="user-img"
                                        class="img-circle"> </a>
                            <ul class="dropdown-menu">
                                <li><a href="{!! url('app/settings') !!}"><i
                                                class="ti-settings m-r-5"></i> {!! tr("settings") !!}</a></li>
                                <li><a href="{!! url('app/logout') !!}"><i
                                                class="ti-power-off m-r-5"></i> {!! tr("logout") !!}</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->

    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>

                    <li class="text-muted menu-title">{!! tr("menu") !!}</li>

                    <li>
                        <a href="{!! url('app/dashboard') !!}" class="waves-effect"><i class="ti-home"></i>
                            <span> {!! tr("dashboard") !!} </span> </a>
                    </li>

                    <li>
                        <a href="{!! route('statistics') !!}" class="waves-effect "><i class="fa fa-bar-chart-o"></i>
                            <span> {!! tr("statistics") !!} </span> </a>
                    </li>
                    <li class="has-sub">
                        <a href="#" class="waves-effect "><i class="fa fa-users"></i>
                            <span> {!! tr("profiles") !!} </span> </a>
                        <ul class="list-unstyled">
                            @foreach($user->getProfiles() as $profile)
                                <li><a href="{!! route('profile',$profile->id) !!}"><i
                                                class="{!! $profile->getIcon() !!}"
                                                style="margin-right:0"></i> {!! $profile->name !!}</a></li>
                            @endforeach
                            <li><a href="{!! route('connect') !!}"><i class="fa fa-plus" style="margin-right:0"></i>
                                    <span>{!! tr("connect_profile") !!}</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{!! route('publishing') !!}" class="waves-effect "><i class="fa fa-bullhorn"></i>
                            <span> {!! tr("posts") !!} </span> <span
                                    class="badge">{!! $user->getScheduledPostsNum()!!}</span></a>
                    </li>
                    </li>
                    <!-- <li> -->
                <!-- <a href="{!! url('app/feeds') !!}" class="waves-effect "><i class="fa fa-rss"></i> -->
                <!-- <span> {!! tr("feeds") !!} </span></a> -->
                    <!-- </li> -->
                    <li>
                        <a href="{!! route('app.notification.index') !!}" class="waves-effect "><i
                                    class="fa fa-bullhorn"></i>
                            <span> {!! tr('notifications') !!} </span><span
                                    class="badge nots_count">{!! $notificationsCount !!}</span> </a>
                    </li>
                    <li>
                        <a href="{!! url('app/team') !!}" class="waves-effect "><i class="fa fa-group"></i>
                            <span> {!! tr("team") !!} </span> </a>
                    </li>
                    {{----}}
                    {{--<li>--}}
                    {{--<a href="{!! route('feeds') !!}" class="waves-effect "><i class="fa fa-newspaper-o"></i>--}}
                    {{--<span> Източници </span> </a>--}}
                    {{--</li>--}}


                    <li>
                        <a href="{!! route('predefined_times') !!}" class="waves-effect "><i class="fa fa-clock-o"></i>
                            <span> {!! tr("publish_times") !!}</span> </a>
                    </li>
                    <li>
                        <a href="{!! route('bitly') !!}" class="waves-effect "><i class="fa fa-link"></i>
                            <span> Bit.ly </span> </a>
                    </li>
                    <li>
                        <a href="{!! url('app/settings') !!}" class="waves-effect "><i class="fa fa-wrench"></i>
                            <span> {!! tr("settings") !!} </span> </a>
                    </li>
                    <li>
                        <a href="{!! url('app/logout') !!}" class="waves-effect "><i class="ti-power-off"></i>
                            <span> {!! tr("logout") !!} </span> </a>
                    </li>


                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <strong>{!! tr("oops") !!}!</strong> {!! Session::get('error') !!}
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <strong>{!! tr('success') !!}!</strong> {!! Session::get('success') !!}
                            </div>
                        @endif
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <strong>{!! tr("oops") !!}!</strong> {!! $error !!}
                            </div>
                        @endforeach
                    </div>
                </div>
                @yield('content')
            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            {!! date("Y") !!} © {!! site_option("site_title")!!}.
        </footer>

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


    <!-- Right Sidebar -->
</div>
<!-- END wrapper -->


<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{!!url('t_assets')!!}/js/jquery.min.js"></script>
<script src="{!!url('t_assets')!!}/js/bootstrap.min.js"></script>
<script src="{!!url('t_assets')!!}/js/detect.js"></script>
<script src="{!!url('t_assets')!!}/js/fastclick.js"></script>
<script src="{!!url('t_assets')!!}/js/jquery.slimscroll.js"></script>
<script src="{!!url('t_assets')!!}/js/jquery.blockUI.js"></script>
<script src="{!!url('t_assets')!!}/js/waves.js"></script>
<script src="{!!url('t_assets')!!}/js/wow.min.js"></script>
<script src="{!!url('t_assets')!!}/js/jquery.nicescroll.js"></script>
<script src="{!!url('t_assets')!!}/js/jquery.scrollTo.min.js"></script>

<script src="{!!url('t_assets')!!}/plugins/peity/jquery.peity.min.js"></script>

<script src="{!!url('t_assets')!!}/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<script src="{!!url('t_assets')!!}/plugins/notifyjs/dist/notify.min.js"></script>
<script src="{!!url('t_assets')!!}/plugins/notifications/notify-metro.js"></script>

<script src="{!!url('t_assets')!!}/pages/jquery.dashboard_3.js"></script>

<script src="{!!url('t_assets')!!}/js/jquery.core.js"></script>
<script src="{!!url('t_assets')!!}/js/jquery.app.js"></script>
<script src="{!!url('assets')!!}/sweetalerts/sweetalert.min.js"></script>
<script>
    $("#sidebar-menu a").each(function () {
        if ($(this).attr("href") == '{!! \URL::full() !!}') {
            $(this).addClass("active");
        }
    });
    function load_notifications() {
        $.get('{!! route('app.notifications.load_last') !!}', function (data) {
            $("#nots_area").html(data);
        });
    }
    function load_notifications_count() {
        $.get('{!! route('app.notifications.load_count') !!}', function (data) {
            $(".nots_count").text(data);
        });
    }
    window.onload = function () {
        load_notifications();
    };


    var conn = new WebSocket('ws://{!! \Config::get('app.hostIp') !!}:3030');
    conn.onopen = function (e) {
        console.log("done");
        conn.send(JSON.stringify({
            name: "init",
            user_id: {!! $user->id !!}
        }));
    };
    function send(json) {
        if (conn.readyState === 1) {
            conn.send(json);
        } else {
            setTimeout(function () {
                send(json);
            }, 500);
        }
    }
    @if(\Session::has('execute'))
        @foreach(\Session::get('execute') as $data)
              send('{!! $data !!}');
    @endforeach
            @endif

            conn.onmessage = function (e) {
        var data = JSON.parse(e.data);
        if (data.name == "new_notification") {
            load_notifications();
            load_notifications_count();
            $.Notification.notify('custom', 'bottom right', data.title, data.description);
        }

    };
</script>
@yield('js')

</body>
</html>