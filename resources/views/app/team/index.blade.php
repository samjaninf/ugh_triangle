@extends('app.layouts.main')

@section('title')
    {!! tr("team") !!}
@stop

@section('content')
    <div class="col-md-12">
        <h4 class="page-title">{!! tr("team") !!}</h4>
        <p class="text-muted page-title-alt"> {!! tr("manage_your_team") !!}
            !</p>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-10">
            <form role="form">
                <div class="form-group contact-search m-b-30">
                    <input type="text" id="search" class="form-control"
                           placeholder="{!! tr('serach_users_in_the_team') !!}...">
                    <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                </div> <!-- form-group -->
            </form>
        </div>
        <div class="col-md-4 col-lg-2">
            @if(\Auth::user()->ref==0)
                <a href="#add_new" class="btn btn-default btn-block btn-md waves-effect waves-light m-b-30"
                   data-toggle="modal"><i class="md md-add"></i> {!! tr("invite") !!}</a>
            @else
                <a href="{!! route('team.leave') !!}"
                   class="btn btn-default btn-block btn-md waves-effect waves-light m-b-30"><i
                            class="fa fa-sign-out"></i> {!! tr("leave_the_team") !!}</a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="card-box m-b-10" id="template" style="display: none">
            <div class="table-box opport-box" style="width:10%;">
                <div class="table-detail">
                    <img src="" alt="img" class="img-circle thumb-lg m-r-15 img">
                </div>

                <div class="table-detail">
                    <div class="member-info" style="word-wrap: break-word;">
                        <h4 class="m-t-0 name"><b>Envato Market Pty Ltd. </b></h4>
                        <p class="text-dark m-b-5"><b>E-mail: </b> <span
                                    class="text-muted email"></span></p>
                    </div>
                </div>
                @if(\Auth::user()->ref == 0)
                    <div class="table-detail table-actions-bar">
                        <a href="#" class="table-action-btn remove"><i class="md md-close"></i></a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-8" id="users">

        </div>
        <div class="col-md-4">
            @foreach($invitationsRequests as $invitation)
                <div class="card-box">
                    {!! tr(":username_invites-you_to_join_his_team", ['username' => $invitation->sender->name]) !!}<br>
                    <small><i class="fa fa-info-circle"></i>
                        {!! tr("by_joining_the_team_you_give_an_access_to_your_profiles") !!}
                    </small>
                    <div class="btn-group btn-group-justified">
                        <a href="{!! route('app.invitation.accept', $invitation->id) !!}" class="btn btn-success"><i
                                    class="fa fa-check"></i> {!! tr("Accept") !!}</a>
                        <a href="{!! route('app.invitation.decline', $invitation->id) !!}" class="btn btn-danger"><i
                                    class="fa fa-times"></i> {!! tr("Decline") !!}</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    @if(\Auth::user()->ref==0)
        <div class="modal fade" id="add_new">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{!! tr("invite") !!}</h4>
                    </div>
                    <div class="modal-body">
                        <strong>E-mail:</strong>
                        <input type="text" class="form-control" id="user_email"
                               placeholder="E-mail">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="add_new_btn"><i class="fa fa-paper-plane"></i>
                            {!! tr("send_the_request") !!}
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endif
@stop

@section('js')
    <script>
        $("#add_new_btn").click(function () {
            $(this).addClass('disabled');
            $.get('{!! url('app/team/add') !!}', {email: $("#user_email").val()}, function (data) {
                sweetAlert(data[0], data[1], data[2]);
                $("#add_new_btn").removeClass('disabled');
                $("#add_new").modal('toggle');
                $("#user_email").val('');
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }).error(function () {
                sweetAlert('{!! tr('oops') !!}', "{!! tr('something_went_wrong_try_again') !!}", "error");
                $("#add_new_btn").removeClass('disabled');
                $("#add_new").modal('toggle');
                $("#user_email").val('');
            });
        });
        function renderList(data) {
            $.each(data, function (el) {
                el = data[el];
                var clone = $("#template").clone();
                clone.find(".name").text(el.name);
                if (el.email == "") clone.find('.email').parent().hide();
                clone.find(".email").text(el.email);
                clone.find("img").attr("src", el.avatar);
                clone.find(".remove").attr("href", "{!! url('app/team/') !!}/" + el.id + "/remove");
                clone.show();
                $("#users").append("<div class='col-md-12 col-lg-6'><div class='card-box'>" + clone.html() + "</div></div>");
            });
            if (data.length == 0) {
                $("#users").html("<h3 class='text-center'><i class='fa fa-coffee'></i> {!! tr('no_users_found') !!}</h3>")
            }
        }
        function loadRes() {
            $.get('{!! route('team.search') !!}', {search: $("#search").val()}, function (data) {
                $("#users").html("");
                renderList(data);
            });
        }
        loadRes();
        $("#search").keyup(function () {
            loadRes();
        });
    </script>
@stop