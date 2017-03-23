<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>{!! site_option("site_title")!!} - {!! tr('forgot_password') !!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="icon" type="image/x-icon" href="{!!url('/')!!}/favicon.ico"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{!!url('theme_assets')!!}/pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{!!url('theme_assets')!!}/pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{!!url('theme_assets')!!}/pages/ico/152.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="{!!url('theme_assets')!!}/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css"/>
    <link href="{!!url('theme_assets')!!}/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{!!url('theme_assets')!!}/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet"
          type="text/css"/>
    <link href="{!!url('theme_assets')!!}/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet"
          type="text/css" media="screen"/>
    <link href="{!!url('theme_assets')!!}/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css"
          media="screen"/>
    <link href="{!!url('theme_assets')!!}/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet"
          type="text/css" media="screen"/>
    <link href="{!!url('theme_assets')!!}/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{!!url('theme_assets')!!}/pages/css/pages.css" rel="stylesheet"
          type="text/css"/>
    <!--[if lte IE 9]>
    <link href="{!!url('theme_assets')!!}/pages/css/ie9.css" rel="stylesheet" type="text/css"/>
    <![endif]-->
    <script type="text/javascript">
        window.onload = function () {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="{!!url('theme_assets')!!}/pages/css/windows.chrome.fix.css" />'
        }
    </script>
</head>
<body class="fixed-header">
<!-- START PAGE-CONTAINER -->
<div class="login-wrapper">
    <!-- START Login Background Pic Wrapper-->
    <div class="bg-pic">
        <!-- START Background Pic-->

        <img src="{!!url('theme_assets')!!}/assets/img/home.png"
             data-src="{!!url('theme_assets')!!}/assets/img/home.png"
             class="lazy"><!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
            <h2 class="semi-bold text-white">
                {!! tr("manage_your_posts") !!}</h2>
            <p class="small">
                {!! tr("in_all_your_social_profiles_from_1_place") !!}
            </p>
        </div>
        <!-- END Background Caption-->
    </div>
    <!-- END Login Background Pic Wrapper-->
    <!-- START Login Right Container-->
    <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="{!!url('theme_assets')!!}/assets/img/logo.png" alt="logo"
                 data-src="{!!url('theme_assets')!!}/assets/img/logo.png" data-src-retina="assets/img/logo_2x.png"
                 width="78" height="22">
            <p class="p-t-35">{!! tr('forgot_password') !!}</p>
            <!-- START Login Form -->
            <form id="form-login" class="p-t-15" role="form" method="post" action="{!! route('forgot_password') !!}">
            {!! csrf_field() !!}
            <!-- START Form Control-->
                @if(\Session::has('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>{!! tr('oops') !!}!</strong> {!! \Session::get('error') !!}
                    </div>
                @endif
                @if(\Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>{!! tr('success') !!}!</strong> {!! \Session::get('success') !!}
                    </div>
                @endif
                <div class="form-group form-group-default">
                    <label>E-mail</label>
                    <div class="controls">
                        <input type="text" name="email" placeholder="E-mail" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 no-padding">
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{!! url('/') !!}" class="text-info small">{!! tr("home") !!}</a>
                    </div>
                </div>
                <button class="btn btn-primary btn-cons m-t-10" type="submit">{!! tr('send') !!}</button>
            </form>
            <div class="pull-bottom sm-pull-bottom">
                <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                    <div class="col-sm-3 col-md-2 no-padding">
                        <img alt="" class="m-t-5" data-src="{!!url('theme_assets')!!}/assets/img/demo/pages_icon.png"
                             data-src-retina="assets/img/demo/pages_icon_2x.png" height="60"
                             src="{!!url('theme_assets')!!}/assets/img/demo/pages_icon.png" width="60">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{!!url('theme_assets')!!}/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/jquery-unveil/jquery.unveil.min.js"
        type="text/javascript"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/jquery-bez/jquery.bez.min.js"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/jquery-ios-list/jquery.ioslist.min.js"
        type="text/javascript"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="{!!url('theme_assets')!!}/assets/plugins/bootstrap-select2/select2.min.js"></script>
<script type="text/javascript" src="{!!url('theme_assets')!!}/assets/plugins/classie/classie.js"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
<script src="{!!url('theme_assets')!!}/assets/plugins/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript"></script>
<script src="{!!url('theme_assets')!!}/pages/js/pages.min.js"></script>
<script src="{!!url('theme_assets')!!}/assets/js/scripts.js" type="text/javascript"></script>
</body>
</html>