<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{!!url('t_assets')!!}/images/favicon_1.ico">

    <title>{!! trans('messages.page_not_found') !!}</title>

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

</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>

<div class="wrapper-page">
    <div class="ex-page-content text-center">
        <div class="text-error"><span class="text-primary">4</span><i class="ti-face-sad text-pink"></i><span
                    class="text-info">4</span></div>
        <h2>Who0ps! {!! trans('messages.page_not_found') !!}</h2><br>
        <p class="text-muted">{!! trans('messages.this_page_can_not_be_found_or_missing') !!}.</p>
        <br>
        <a class="btn btn-default waves-effect waves-light"
           href="{!! url('/') !!}"> {!! trans("messages.return_home") !!}</a>

    </div>
</div>


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


<script src="{!!url('t_assets')!!}/js/jquery.core.js"></script>
<script src="{!!url('t_assets')!!}/js/jquery.app.js"></script>

</body>
</html>