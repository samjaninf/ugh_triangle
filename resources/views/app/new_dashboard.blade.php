@extends('app.layouts.main')

@section('title')
    Home
@stop

@section('css')
    {!! Form::open(['id' => 'csvForm','url' => 'app/csv', 'files' => true]) !!}
    <input type="file" style="display:none" id="csvFile" name="file">
    {!! Form::close() !!}
    <link href="{!!url('assets')!!}/css/jquery-ui.min.css" rel="stylesheet">
    <div class="modal fade" id="csvModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{!! trans('messages.how_to_import') !!}</h4>
                </div>
                <div class="modal-body">
                    <p>{!! trans('messages.create_table_with_4_cols') !!}</p>
                    <p><i class="fa fa-info"></i> {!! trans('messages.the_imported_posts') !!}</p>
                    <ul>
                        <li>{!! trans('messages.column') !!} 1 (content): {!! trans('messages.post_content') !!}
                            ({!! trans('messages.text_only') !!})
                        </li>
                        <li>{!! trans('messages.column') !!} 2 (date): {!! trans('messages.date_of_publication') !!}
                            (Y-m-d H:m,
                            Ex. : 2016-02-15 23:05)
                        </li>
                        <li>{!! trans('messages.column') !!} 3 (image): URL ({!! trans('messages.optional') !!})</li>
                        <li>{!! trans('messages.column') !!} 4 (link): {!! trans('messages.link') !!}
                            ({!! trans('messages.optional') !!})
                        </li>
                    </ul>
                    <h3>{!! trans('messages.example') !!}</h3>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Text</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Some Status</td>
                            <td>2015-11-05 21:30</td>
                            <td>http://popsop.com/wp-content/uploads/get_some_nuts_snickers.jpg</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{!! trans('messages.close') !!}</button>
                    <button type="button" id="uploadCsv" onclick="$('#csvFile').click()"
                            class="btn btn-primary">{!! trans('messages.upload') !!} .CSV
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <link href="{!!url('assets')!!}/css/datepicker_addon.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{!! url('assets') !!}/css/jquery.fileupload.css">
    <style>
        .tile-bl {
            background-color: #009DC7;
            text-align: center;
            min-width: 80px;
        }

        .tile-bl img {
            width: 100%;
        }

        .tile-bl .t-overflow {
            color: #FFF;
            bottom: 0;
        }
    </style>
@stop

@section('content')

    <div id="msg_area"></div>
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">{!! trans('messages.dashboard') !!}</h4>

            <p class="text-muted page-title-alt"> {!! trans('messages.manage_your_profiles_and_posts') !!}
                !</p>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4">
            <div class="card-box">
                <div class="bar-widget">
                    <div class="table-box">
                        <div class="table-detail">
                            <div class="iconbox bg-info">
                                <i class="icon-layers"></i>
                            </div>
                        </div>

                        <div class="table-detail" style="padding-right: 140px;">
                            <h4 class="m-t-0 m-b-5"><b>{!! $past_posts !!}</b></h4>

                            <p class="text-muted m-b-0 m-t-0">{!! trans('messages.published_posts') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-box">
                <div class="bar-widget">
                    <div class="table-box">
                        <div class="table-detail">
                            <div class="iconbox bg-custom">
                                <i class="icon-layers"></i>
                            </div>
                        </div>

                        <div class="table-detail" style="padding-right: 100px;">
                            <h4 class="m-t-0 m-b-5"><b>{!! count($profiles) !!}</b></h4>

                            <p class="text-muted m-b-0 m-t-0">{!! trans('messages.connected_profiles') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-box">
                <div class="bar-widget">
                    <div class="table-box">
                        <div class="table-detail">
                            <div class="iconbox bg-danger">
                                <i class="icon-layers"></i>
                            </div>
                        </div>

                        <div class="table-detail" style="padding-right: 150px;">
                            <h4 class="m-t-0 m-b-5"><b>{!! $future_posts !!}</b></h4>

                            <p class="text-muted m-b-0 m-t-0">{!! trans('messages.scheduled_posts') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-lg-4">
            {!! trans('messages.connect_profile') !!}
            <div class="list-group">
                <ul class="list-group">
                    <li class="list-group-item fb"><a href="{!! url('app/connect/fb_profile') !!}"><i
                                    class="ti-facebook"></i> Facebook</a></li>
                    <li class="list-group-item connect fb"><a href="javascript:;"
                                                              data-href="{!! url('app/connect/fb_page') !!}"><i
                                    class="ti-facebook"></i> <span class="type">Facebook Page</span></a></li>
                    <li class="list-group-item connect fb"><a href="javascript:;"
                                                              data-href="{!! url('app/connect/fb_group') !!}"><i
                                    class="ti-facebook"></i><span class="type"> Facebook Group</span></a></li>
                    <li class="list-group-item connect fb"><a href="javascript:;"
                                                              data-href="{!! url('app/connect/fb_event') !!}"><i
                                    class="ti-facebook"></i><span class="type"> Facebook Event</span></a></li>
                    <li class="list-group-item twitter"><a href="{!! url('app/connect/twitter') !!}"><i
                                    class="ti-twitter"></i> Twitter</a></li>
                    <li class="list-group-item linkedin"><a href="{!! url('app/connect/linkedin') !!}"><i
                                    class="ti-linkedin"></i> LinkedIn</a></li>
                    <li class="list-group-item linkedin connect"><a href="javascript:;"
                                                                    data-href="{!! url('app/connect/linkedin_page') !!}"><i
                                    class="ti-linkedin"></i> <span class="type">LinkedIn Page</span></a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            {!! trans('messages.connected_profile') !!}
            <div class="list-group">
                <ul class="list-group">
                    @foreach($profiles as $profile)
                        <li class="list-group-item fb {!! $profile->is_active ?'success-item':''!!}"><i
                                    class="ti-facebook"></i> {!! $profile->name !!}
                            [{!! $profile->getNameType() !!}] - [<a href="#" class="profile"
                                                                    profile-id="{!! $profile->id !!}"
                                                                    state="{!! $profile->is_active !!}">{!! $profile->is_active?trans('messages.disable'):trans('messages.activate') !!}</a>]
                            [<a href="{!! url('app/profile/'.$profile->id.'/delete') !!}">{!! trans('messages.delete') !!}</a>]
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-box">
                <h4 class="text-dark  header-title m-t-0 m-b-30">{!! trans("messages.last_seven_days_posts") !!}</h4>

                <div class="widget-chart text-center">
                    <div id="sparkline1"></div>
                    <ul class="list-inline m-t-15">
                        <li>
                            <h5 class="text-muted m-t-20">All Posts</h5>
                            <h4 class="m-b-0">{!! count($posts) !!}</h4>
                        </li>
                        <li>
                            <h5 class="text-muted m-t-20">Last week</h5>
                            <h4 class="m-b-0">{!! \App\Post::where('time','>',time()-(86400*7))->count() !!}</h4>
                        </li>
                        <li>
                            <h5 class="text-muted m-t-20">Last Month</h5>
                            <h4 class="m-b-0">{!! \App\Post::where('time','>',time()-(86400*30))->count() !!}</h4>
                        </li>
                    </ul>
                </div>
            </div>

        </div>


    </div>


    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            {!! Form::open(['id'=>'main_form','url' => 'app/post', 'files' => true]) !!}
            <button type="submit" style="display:none" id="submit"></button>
            <input type="hidden" id="type" name="type">
            <input type="hidden" id="fileUrls" name="urls">
            <input type="hidden" id="submit_type" name="submit">
            <ul class="nav nav-tabs navtab-bg nav-justified">
                <li class="active">
                    <a href="#home1" id="share_status" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">{!! trans('messages.normal_post') !!}</span>
                    </a>
                </li>
                <li>
                    <a href="#profile1" id="share_link" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                        <span class="hidden-xs">{!! trans('messages.link') !!}</span>
                    </a>
                </li>
                <li class="">
                    <a href="#messages1" id="share_photo" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                        <span class="hidden-xs">{!! trans('messages.image') !!}</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home1">
                </div>
                <div class="tab-pane " id="profile1">
                    <strong>{!! trans('messages.link') !!}</strong>
                    <input type="text" name="link" id="link" class="form-control"
                           placeholder="{!! trans('messages.link') !!}">
                    <br>
                </div>
                <div class="tab-pane" id="messages1">
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <span class="btn btn-success btn-block fileinput-button" style="margin-bottom: 40px;">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>{!! trans('messages.choose_a_picture') !!}</span>
                        <input id="fileupload" type="file" name="files[]" multiple>
                    </span>

                    <br>
                    <i class="fa fa-info"></i> {!! trans('messages.dbclick_image_to_delete') !!}<br>

                    <div class="files" style="margin-bottom: 30px;">
                        <div class="row" id="files"></div>
                    </div>
                </div>
                <strong>{!! trans('messages.status') !!}</strong>
                <textarea name="text" rows="10" class="form-control"
                          placeholder="{!! trans('messages.status') !!}..."
                          id="status"></textarea>

                <div class="btn-group btn-group-justified" style="margin-top: 20px;">
                    <a id="schedule_in_time" class="btn btn-info "><i
                                class="fa fa-calendar"></i> {!! trans('messages.schedule_in_predefined_post_times') !!}
                    </a>
                    <a data-toggle="modal" href="#csvModal" class="btn btn-danger btn-sm"><i
                                class="fa fa-table"></i> {!! trans('messages.import') !!} .csv</a>
                </div>
                <div class="btn-group btn-group-justified">
                    <input type="hidden" id="date" name="date">
                    <a id="schedule" class="btn btn-primary"><i
                                class="fa fa-calendar"></i> {!! trans('messages.schedule') !!}
                    </a>
                    <a id="post_now" class="btn btn-success"><i
                                class="fa fa-bullhorn"></i>{!! trans('messages.post_now') !!}</a>
                </div>

            </div>
            {!! Form::close() !!}

        </div>
    </div>

    <!-- end row -->

    <div class="row">

        <div class="col-lg-12">

            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        {!! trans('messages.posts') !!}
                    </h3>

                    <div class="portlet-widgets">
                        <span class="divider"></span>
                        <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i
                                    class="ion-minus-round"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="footer_area"></div>
            </div>
        </div> <!-- end col -->
    </div>

    <div class="modal fade" id="connect">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('js')
    <script src="{!! url('assets/js/jquery.form.min.js') !!}"></script>
    <script src="{!!url('assets')!!}/js/jquery-ui.min.js"></script>
    <script src="{!!url('assets')!!}/js/datepicker_addon.js"></script>
    <script src="{!! url('assets') !!}/js/vendor/jquery.ui.widget.js"></script>
    <script src="{!! url('assets') !!}/js/jquery.iframe-transport.js"></script>
    <script src="{!! url('assets') !!}/js/jquery.fileupload.js"></script>

    <script>
        $(document).ready(function () {


            var DrawSparkline = function () {
                $('#sparkline1').sparkline({!! $last_seven_days_posts !!}, {
                    type: 'line',
                    width: $('#sparkline1').width(),
                    height: '165',
                    chartRangeMax: 50,
                    lineColor: '#fb6d9d',
                    fillColor: 'transparent',
                    highlightLineColor: 'rgba(0,0,0,.1)',
                    highlightSpotColor: 'rgba(0,0,0,.2)'
                });


            };


            DrawSparkline();

            var resizeChart;

            $(window).resize(function (e) {
                clearTimeout(resizeChart);
                resizeChart = setTimeout(function () {
                    DrawSparkline();
                }, 300);
            });
        });
        $("#csvFile").change(function () {
            $("#csvModal").modal('hide');
            $("#postingModal").modal("show");
            $("#csvForm").ajaxSubmit({
                beforeSubmit: function () {
                },
                success: function (data) {
                    $("#postingModal").modal("hide");
                    if (data[0] == 'e') {
                        add_box("error", data[1]);
                    } else {
                        add_box("success", data[1]);
                    }
                }
            });
        });
        function load_footer() {
            $.get('{!! url('app/dashboard_footer') !!}', function (data) {
                var f_area = "#footer_area";
                $(f_area).html(data);
                $(f_area).on("click", ".up", function () {
                    var post_id = $(this).attr("post-id");
                    $.get('{!! url('app') !!}' + "/up/post", {id: post_id}, function (data) {
                        load_footer();
                    });
                });
                $(f_area).on("click", ".down", function () {
                    var post_id = $(this).attr("post-id");
                    $.get('{!! url('app') !!}' + "/down/post", {id: post_id}, function (data) {
                        load_footer();
                    });
                });
            });
        }
        var box_id = 0;
        function add_box(type, msg) {
            box_id++;
            if (type == "error") {
                $("#msg_area").html($("#msg_area").html() + '<div class="alert alert-danger" box-id="' + box_id + '"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Oops!</strong><br> ' + msg);
            } else {
                $("#msg_area").html($("#msg_area").html() + '<div class="alert alert-success" box-id="' + box_id + '"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success!</strong><br> ' + msg);
            }
            var l = $("#msg_area").find('.alert').length;
            if (l > 2) {
                $("#msg_area").find('div[box-id!=' + box_id + ']').remove();
            }
        }
        function processing(val) {
            if (!val) {
                $(".btn-group").hide();
                $("#processing").show();
            } else {
                $(".btn-group").show();
                $("#processing").hide();
            }
        }
        function submit_form() {
            $("#main_form").ajaxSubmit({
                beforeSubmit: function () {
                    if ($("#status").val().trim().length > 0) {
                        processing(0);
                        if (!$(".profile[state=1]").length) {
                            processing(1);
                            add_box("error", "{!! trans('messages.you_have_no_activated_profiles') !!}");
                            return false;
                        }
                        if ($("#type").val() == "photo") {
                            if (!to_upload.length) {
                                add_box("error", "{!! trans('messages.image_is_required') !!}");
                                processing(1);
                                return false;
                            } else {
                                return true;
                            }
                        }
                        if ($("#type").val() == "link") {
                            var urlregex = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/;
                            var r = urlregex.test($("#link").val());
                            if (!r) {
                                add_box("error", '{!! trans('messages.invalid_url') !!}');
                                processing(1);
                                return false;
                            } else {
                                return true;
                            }
                        }
                        return true;
                    } else {
                        add_box("error", "{!! trans('messages.the_status_field_is_required') !!}");
                        processing(1);
                        return false;
                    }
                },
                success: function (data) {
                    $('#progress .progress-bar').css(
                            'width',
                            '0%'
                    );
                    $('#files').html("");
                    to_upload = [];
                    $("#status").val("");
                    $("input[name=_token]").val(data);
                    processing(1);
                    if (data[0] == 'e') {
                        add_box("error", data[1]);
                    } else {
                        add_box("success", data[1]);
                    }
                    load_footer();
                }
            });
        }
        load_footer();
        $("#share_status").click(function () {
            $("#type").val("status");
        });
        $("#share_photo").click(function () {
            $("#type").val("photo");
        });
        $("#share_link").click(function () {
            $("#type").val("link");
        });
        $("#date").datetimepicker({
            minDate: '+0',
            maxDate: '+90',
            onClose: function () {
                submit_form();
            }
        });
        $("#schedule").click(function () {
            $("#submit_type").val("schedule");
            $("#date").datetimepicker('show');
        });
        $("#post_now").click(function () {
            $("#submit_type").val("now");
            submit_form();
        });
        $("#schedule_in_time").click(function () {
            $("#submit_type").val("in_time");
            submit_form();
        });
        var to_upload = [];
        var url = '{!! url('app/upload') !!}';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            add: function (e, data) {
                var goUpload = true;
                var uploadFile = data.files[0];
                if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(uploadFile.name)) {
                    add_box('error', '{!! trans('messages.image_is_required') !!}');
                    goUpload = false;
                }
                if (uploadFile.size > 2000000) { // 2mb
                    add_box('error', '{!! trans('messages.max_file_size_is_2_mb') !!}');
                    goUpload = false;
                }
                if (goUpload == true) {
                    data.submit();
                }
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    to_upload.push(file.url);
                    $("#fileUrls").val(JSON.stringify(to_upload));
                    console.log(to_upload);
                    $('#files').html($("#files").html() + "<img src='" + file.thumbnailUrl + "'  file-name='" + file.url + "' class='img-thumbnail'/>")
                });
                $("#files").on("dblclick", "img", function () {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                            'width',
                            '0%'
                    );
                    $(this).hide();
                    var name = $(this).attr("file-name");
                    var i = to_upload.indexOf(name);
                    if (i != -1) {
                        to_upload.splice(i, 1);
                    }
                    console.log(to_upload);
                    $.get('{!! url('app/upload/delete') !!}', {name: name});
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');

        $(".profile").click(function () {
            var elem = $(this);
            var state = elem.attr("state");
            var new_state;
            if (parseInt(state)) new_state = 0; else new_state = 1;
            elem.attr("state", new_state);
            $.get('{!! url("app/profile/turn")!!}', {
                id: elem.attr("profile-id"),
                state: new_state
            }, function () {
                if (new_state) {
                    elem.parent().addClass("success-item");
                    elem.text("{!! trans("messages.disable") !!}");
                    add_box("success", "{!! trans('messages.profile_successfully_activated') !!}");
                } else {
                    elem.text("{!! trans("messages.activate") !!}");
                    elem.parent().removeClass("success-item");
                    add_box("success", "{!! trans('messages.profile_successfully_disabled') !!}");
                }
            });
        });

        $(".connect").click(function () {
            var el = $(this);
            $.get($(this).find("a").attr("data-href"), function (data) {
                $("#connect .modal-body").html(data);
                $("#connect .modal-title").html(el.find(".type").text());
                $("#connect").modal('show');

            });
        });
    </script>
@stop

