<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <link rel="shortcut icon" href="{!!url('favicon.ico')!!}">

    <title>{!! site_option("site_title")!!} | Admin Panel</title>

    <link href="{!!url('t_assets')!!}/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('t_assets')!!}/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('t_assets')!!}/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('t_assets')!!}/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('t_assets')!!}/css/pages.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('t_assets')!!}/css/responsive.css" rel="stylesheet" type="text/css"/>

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
                <a href="index.html" class="logo">Admin Panel</a>
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
                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i
                                        class="icon-size-fullscreen"></i></a>
                        </li>

                        <li class="dropdown">
                            <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img
                                        src="{!! \Auth::user()->getAvatar() !!}" alt="user-img"
                                        class="img-circle"> </a>
                            <ul class="dropdown-menu">
                                <li><a href="{!! url('admin/logout') !!}"><i
                                                class="ti-power-off m-r-5"></i> {!! trans('messages.logout') !!}</a>
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

                    <li class="text-muted menu-title">{!! trans('messages.menu') !!}</li>

                    <li>
                        <a href="{!! url('admin/dashboard') !!}" class="waves-effect"><i class="ti-home"></i>
                            <span> {!! trans('messages.dashboard') !!} </span> </a>
                    </li>

                    <li>
                        <a href="{!! url('admin/users') !!}" class="waves-effect "><i class="ti-user"></i>
                            <span> {!! trans('messages.users') !!} </span> </a>
                    </li>
                    <li>
                        <a href="{!! url('admin/translations') !!}" class="waves-effect "><i class="ti-user"></i>
                            <span> {!! trans('messages.translations') !!} </span> </a>
                    </li>

                    <li>
                        <a href="{!! url('admin/settings') !!}" class="waves-effect "><i class="ti-settings"></i>
                            <span>{!! trans('messages.settings') !!} </span> </a>
                    </li>

                    <li>
                        <a href="{!! url('admin/logout') !!}" class="waves-effect "><i class="ti-power-off"></i>
                            <span> {!! trans('messages.logout') !!} </span> </a>
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
                                <strong>{!! tr('oops') !!}!</strong> {!! Session::get('error') !!}
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
                                <strong>Упс!</strong> {!! $error !!}
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
<script src="https://code.jquery.com/jquery-2.2.3.js"></script>
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


<script src="{!!url('t_assets')!!}/pages/jquery.dashboard_3.js"></script>

<script src="{!!url('t_assets')!!}/js/jquery.core.js"></script>
<script src="{!!url('t_assets')!!}/js/jquery.app.js"></script>
<script>
    $("#sidebar-menu a").each(function () {
        if ($(this).attr("href") == '{!! \URL::full() !!}') {
            $(this).addClass("active");
        }
    });
</script>
@yield('js')

</body>
</html>