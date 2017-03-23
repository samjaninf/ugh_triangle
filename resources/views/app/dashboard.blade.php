@extends('app.layouts.main')

@section('title')
    {{ tr("dashboard") }}
@stop

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{url('assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/datepicker_addon.css')}}">
    <link rel="stylesheet" href="{{ url('assets/css/jquery.fileupload.css') }}">
    <link rel="stylesheet" href="{{url('assets/css/jquery-ui-theme.min.css')}}">
@stop

@section('content')
    <div id="msg_area"></div>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-title">{{ tr("dashboard") }}</h4>

            <p class="text-muted page-title-alt"> {{ tr("manage_your_posts") }}
                !</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="text-center" id="processing" style="display: none">
                <i class="fa fa-spinner fa-spin"></i> {{ tr("processing") }}
                <br><br>
            </div>
            {!!   Form::open(['id'=>'main_form','url' => 'app/post', 'files' => true])!!}
            <button type="submit" style="display:none" id="submit"></button>
            <input type="hidden" id="type" name="type">
            <input type="hidden" id="fileUrls" name="urls">
            <input type="hidden" id="submit_type" name="submit">
            <ul class="nav nav-tabs navtab-bg nav-justified">
                <li class="active">
                    <a href="#home1" id="share_status" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">{{ tr("status") }}</span>
                    </a>
                </li>
                <li>
                    <a href="#profile1" id="share_link" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                        <span class="hidden-xs">{{ tr("link") }}</span>
                    </a>
                </li>
                <li class="">
                    <a href="#messages1" id="share_photo" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                        <span class="hidden-xs">{{ tr("picture") }}</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home1">
                </div>
                <div class="tab-pane " id="profile1">
                    <strong>{{ tr("link") }}</strong>
                    <input type="text" name="link" id="link" class="form-control"
                           placeфholder="{{ tr('link') }}">
                    <br>
                </div>
                <div class="tab-pane" id="messages1">
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <span class="btn btn-success btn-block fileinput-button" style="margin-bottom: 40px;">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>{{ tr("choose_a_picture") }}</span>
                        <input id="fileupload" type="file" name="files[]" multiple>
                    </span>

                    <br>
                    <i class="fa fa-info"></i> {{ tr("double_click_the_picture_in_order_to_delete_it") }}<br>

                    <div class="files" style="margin-bottom: 30px;">
                        <div class="row" id="files"></div>
                    </div>
                </div>
                <strong>{{ tr("status") }}</strong>
                <div class="btn-group pull-right">
                    <a href="#load_texts" id="load_texts_toggle" data-toggle="modal" class="btn btn-primary btn-xs"><i
                                class="fa fa-folder-open-o"></i> {{ tr("load") }}</a>
                    <a href="javascript:;" id="saveText" class="btn btn-success btn-xs" style="display: none"><i
                                class="fa fa-save"></i> {{ tr("save") }}</a>
                </div>
                <textarea name="text" rows="10" class="form-control"
                          placeholder="{{ tr("status") }}..."
                          id="status"></textarea>
                <div class="pull-right">
                    <span class="char-count">1200</span><span class="max-limit" style="display: none">1200</span>
                    {{ tr('symbols left') }}
                </div>
                <br>
                <a class="btn btn-primary" data-toggle="modal" href="#profiles"><i
                            class="fa fa-users"></i> {{ tr('select_profiles') }}</a>
                <div class="modal fade" id="profiles">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                <h4 class="modal-title">{{ tr('select_profiles') }}</h4>
                                <small>
                                    <i class="fa fa-info"></i> {{ tr('select_profiles_where_the_posts_will_be_published') }}
                                </small>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group custom-list-group">
                                    @forelse($profiles as $profile)
                                        <li class="list-group-item profile {{ $profile->is_active?"enabled":"" }}"
                                            p-id="{{ $profile->id }}"
                                            is-twitter="{{ $profile->type=="twitter"?1:0 }}"
                                            state="{{ $profile->is_active }}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <img src="{{ $profile->avatar }}" class="img-rounded pull-right"/>
                                                    <div class="pull-left">
                                                        {{ $profile->name }} <br>
                                                        <small>
                                                            <i class="{{ $profile->getIcon() }}"></i> {{ $profile->getNameType() }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                    @empty
                                        <h4 class="text-center">{{ tr("you_have_no_connected_profiles") }}</h4>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal">{{ tr("continue") }}</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="btn-group btn-group-justified" style="margin-top: 20px;">
                    <a id="schedule_in_time" class="btn btn-info "><i
                                class="fa fa-calendar"></i> {{ tr("auto_schedule") }}
                    </a>
                    <input type="hidden" id="date" name="date">
                    <a id="schedule" class="btn btn-primary"><i
                                class="fa fa-calendar"></i> {{ tr("schedule") }}
                    </a>
                    <a id="post_now" class="btn btn-success"><i
                                class="fa fa-bullhorn"></i> {{ tr("post_now") }}</a>
                </div>

            </div>
            {!! Form::close() !!}

        </div>
    </div>

    <div class="modal fade" id="load_texts">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ tr("drafts") }}</h4>
                </div>
                <div class="modal-body">
                    <div class="list-group" id="texts_area">

                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@stop

@section('js')
    <script src="{{url('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{url('assets/js/datepicker_addon.js')}}"></script>
    <script src="{{ url('assets/js/jquery.form.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.fileupload.js') }}"></script>
    <script src="{{ url('assets/js/jquery.iframe-transport.js') }}"></script>
    @include('app.extra.dashboard_js')
@stop

