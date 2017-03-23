@extends('admin.layout.main')

@section('title')
    {!! tr('settings') !!}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">{!! tr('settings') !!} </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="portlet">
                <div class="portlet-heading bg-success">
                    <h3 class="portlet-title">
                        {!! tr('settings') !!}
                    </h3>

                    <div class="clearfix"></div>
                </div>
                <div id="bg-success" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        {!! Form::open(['url' => "admin/settings"]) !!}
                        <strong>API Keys</strong>
                        <hr>
                        <strong>Facebook API Key</strong>
                        <input type="text" class="form-control" name="keys[fb_api_key]"
                               value="{!! \App\Setting::find("fb_api_key")->value !!}">
                        <strong>Facebook API Secret</strong>
                        <input type="text" class="form-control" name="keys[fb_api_secret]"
                               value="{!! \App\Setting::find("fb_api_secret")->value !!}">
                        <strong>Twitter API Key</strong>
                        <input type="text" class="form-control" name="keys[twitter_api_key]"
                               value="{!! \App\Setting::find("twitter_api_key")->value !!}">
                        <strong>Twitter API Secret</strong>
                        <input type="text" class="form-control" name="keys[twitter_api_secret]"
                               value="{!! \App\Setting::find("twitter_api_secret")->value !!}">
                        <strong>LinkedIn API Key</strong>
                        <input type="text" class="form-control" name="keys[linkedin_api_key]"
                               value="{!! \App\Setting::find("linkedin_api_key")->value !!}">
                        <strong>LinkedIn API Secret</strong>
                        <input type="text" class="form-control" name="keys[linkedin_api_secret]"
                               value="{!! \App\Setting::find("linkedin_api_secret")->value !!}">
                        <strong>BitLy API Key</strong>
                        <input type="text" class="form-control" name="keys[bitly_api_key]"
                               value="{!! \App\Setting::find("bitly_api_key")->value !!}">
                        <strong>BitLy API Secret</strong>
                        <input type="text" class="form-control" name="keys[bitly_api_secret]"
                               value="{!! \App\Setting::find("bitly_api_secret")->value !!}">
                        <strong>Meta Tags</strong>
                        <hr>
                        <strong>{!! tr('keywords') !!}</strong>
                        <input type="text" name="s[site_keywords]" class="form-control"
                               value="{!! \App\Setting::find("site_keywords")->value !!}">
                        <strong>{!! tr('author') !!}</strong>
                        <input type="text" name="s[site_author]" class="form-control"
                               value="{!! \App\Setting::find("site_author")->value !!}">
                        <strong>{!! tr('description') !!}</strong>
                        <textarea name="s[site_description]" rows="10"
                                  class="form-control">{!! \App\Setting::find("site_description")->value !!}</textarea>
                        <br>
                        <button class="btn btn-primary">{!! tr('update') !!}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
