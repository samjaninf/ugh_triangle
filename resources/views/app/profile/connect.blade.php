@extends('app.layouts.main')

@section('title')
    {!! trans('messages.connect_profile') !!}
@stop

@section('content')
    <h3>Facebook</h3>
    <div class="row">
        <div class="col-sm-3">
            <div class="portlet">
                <div class="portlet-heading bg-primary">
                    <h3 class="portlet-title">
                        Facebook Profile
                    </h3>

                    <div class="portlet-widgets">
                        <a href="{!! route('connect.facebook_profile') !!}" class="label label-success"><i
                                    class="fa fa-link"></i> {!!  tr('connect') !!}</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-primary1" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        {!! tr('fb_desc') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="portlet">
                <div class="portlet-heading bg-primary">
                    <h3 class="portlet-title">
                        Facebook Page
                    </h3>

                    <div class="portlet-widgets">
                        <a href="{!! \Auth::user()->hasFacebookProfile()?route("connect.facebook_page"):route("connect.facebook_profile") !!}"
                           class="label label-success"><i
                                    class="fa fa-link"></i> {!!  tr('connect') !!}</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-primary1" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        {!! tr('fb_desc') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="portlet">
                <div class="portlet-heading bg-primary">
                    <h3 class="portlet-title">
                        Facebook Group
                    </h3>

                    <div class="portlet-widgets">
                        <a href="{!! \Auth::user()->hasFacebookProfile()?route("connect.facebook_group"):route("connect.facebook_profile") !!}"
                           class="label label-success"><i
                                    class="fa fa-link"></i>
                            {!!  tr('connect') !!}</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-primary1" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        {!! tr('fb_desc') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="portlet">
                <div class="portlet-heading bg-primary">
                    <h3 class="portlet-title">
                        Facebook Event
                    </h3>

                    <div class="portlet-widgets">
                        <a href="{!! \Auth::user()->hasFacebookProfile()?route("connect.facebook_event"):route("connect.facebook_profile") !!}"
                           class="label label-success"><i
                                    class="fa fa-link"></i>
                            {!!  tr('connect') !!}</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-primary1" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        {!! tr('fb_desc') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3>Twitter</h3>
    <div class="row">
        <div class="col-sm-3">
            <div class="portlet">
                <div class="portlet-heading bg-info">
                    <h3 class="portlet-title">
                        Twitter Profile
                    </h3>

                    <div class="portlet-widgets">
                        <a href="{!! route('connect.twitter') !!}" class="label label-primary"><i
                                    class="fa fa-link"></i>
                            {!!  tr('connect') !!}</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-primary1" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        {!! tr('twitter_desc') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3>LinkedIn</h3>
    <div class="row">
        <div class="col-sm-3">
            <div class="portlet">
                <div class="portlet-heading bg-purple">
                    <h3 class="portlet-title">
                        LinkedIn Profile
                    </h3>

                    <div class="portlet-widgets">
                        <a href="{!! route('connect.linkedin') !!}" class="label label-primary"><i
                                    class="fa fa-link"></i>
                            {!!  tr('connect') !!}</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-primary1" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        {!! tr('linkedin_desc') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="portlet">
                <div class="portlet-heading bg-purple">
                    <h3 class="portlet-title">
                        LinkedIn Page
                    </h3>

                    <div class="portlet-widgets">
                        <a href="{!! \Auth::user()->hasLinkedInProfile()?route('connect.linkedin_page'):route('connect.linkedin') !!}"
                           class="label label-primary"><i
                                    class="fa fa-link"></i>
                            {!!  tr('connect') !!}</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-primary1" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        {!! tr('linkedin_desc') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<h3>Pinterest</h3>--}}
    {{--<div class="row">--}}
    {{--<div class="col-sm-3">--}}
    {{--<div class="portlet">--}}
    {{--<div class="portlet-heading bg-danger">--}}
    {{--<h3 class="portlet-title">--}}
    {{--Pinterest--}}
    {{--</h3>--}}

    {{--<div class="portlet-widgets">--}}
    {{--<a href="javascript:;" class="label label-primary"><i--}}
    {{--class="fa fa-link"></i>--}}
    {{--{!!  tr('connect') !!}</a>--}}
    {{--</div>--}}
    {{--<div class="clearfix"></div>--}}
    {{--</div>--}}
    {{--<div id="bg-primary1" class="panel-collapse collapse in">--}}
    {{--<div class="portlet-body">--}}
    {{--Може да публикуваш снимки.--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@stop