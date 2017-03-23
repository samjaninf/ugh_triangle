<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{!!url('t_assets')!!}/images/favicon_1.ico">

    <title>Admin Panel</title>

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
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"><strong class="text-custom">Triangle</strong> Admin Panel</h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal m-t-20" action="{!! url('admin/login') !!}" method="post">
                {!! csrf_field() !!}
                @if(\Session::has('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Oops!</strong> {!! \Session::get('error') !!}
                    </div>
                @endif
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="E-mail" name="email">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required="" placeholder="Password" name="password">
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Log
                            In
                        </button>
                    </div>
                </div>
            </form>

        </div>
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