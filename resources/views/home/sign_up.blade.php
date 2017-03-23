<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>{!! site_option("site_title")!!} - Регистрация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="apple-touch-icon" href="{!!url('theme_assets')!!}/pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{!!url('theme_assets')!!}/pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{!!url('theme_assets')!!}/pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{!!url('theme_assets')!!}/pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="{!!url('theme_assets')!!}/favicon.ico"/>
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
<body class="fixed-header   ">
<div class="register-container full-height sm-p-t-30">
    <div class="container-sm-height full-height">
        <div class="row row-sm-height">
            <div class="col-sm-12 col-sm-height col-middle ">
                @if(\Session::has('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Oops!</strong> {!! \Session::get('error') !!}
                    </div>
                @endif
                @if(\Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Yupiii!</strong> {!! \Session::get('success') !!}
                    </div>
                @endif
                @foreach($errors->all() as $err)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Oops!</strong> {!! $err !!}
                    </div>
                @endforeach
                <div class="text-center">
                    <img src="{!!url('theme_assets')!!}/assets/img/logo.png" alt="logo"
                         data-src="{!!url('theme_assets')!!}/assets/img/logo.png"
                         data-src-retina="assets/img/logo_2x.png"
                         width="150">
                </div>
                <form id="form-register" class="p-t-15" role="form" action="{!! route('sign_up') !!}" method="post">
                    {!! csrf_field() !!}
                    @if(\Request::has('ref'))
                        <input type="hidden" name="ref" value="{!! \Request::get('ref') !!}">
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group form-group-default">
                                <label>{!! tr('first_name') !!}</label>
                                <input type="text" name="fname" placeholder="{!! tr('first_name') !!}"
                                       class="form-control"
                                >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-group-default">
                                <label>{!! tr('last_name') !!}</label>
                                <input type="text" name="lname" placeholder="{!! tr('last_name') !!}"
                                       class="form-control"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Email</label>
                                <input type="email" name="email"
                                       {!! \Request::has('email') ? 'value="'.\Request::get('email').'"' :""!!}
                                       placeholder="{!! tr('enter_an_active_email') !!}"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>{!! tr('password') !!}</label>
                                <input type="password" name="password" placeholder="{!! tr('password_must_be') !!}"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{!!url('/')!!}" class="text-info small">{!! tr('already_have_an_account') !!}</a>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-cons m-t-10"
                            type="submit">{!! tr('sign_up') !!}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN VENDOR JS -->
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
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{!!url('theme_assets')!!}/pages/js/pages.min.js"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{!!url('theme_assets')!!}/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->

</body>
</html>