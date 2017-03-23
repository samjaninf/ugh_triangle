@extends('app.layouts.main')

@section('title')
    {!! tr('posts') !!}
@stop

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            {!! Form::open(['url' => 'app/publishing', 'method' => "get", "id" => "search"]) !!}
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bullhorn"></i> {!! tr('filters') !!}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <strong>{!! tr('from') !!}: </strong>
                            <input type="text" class="form-control date" id="date_from"
                                   value="{!! \Request::get('date_from') !!}" name="date_from">
                        </div>
                        <div class="col-xs-6">
                            <strong>{!! tr('to') !!}: </strong>
                            <input type="text" class="form-control date" id="date_to"
                                   value="{!! \Request::get('date_to') !!}" name="date_to">
                        </div>
                    </div>
                    <strong>{!! tr("select_profile") !!}</strong>
                    <select name="profile" class="form-control" id="profile">
                        <option value="0">{!! tr('all_profiles') !!}</option>
                        @foreach(\Auth::user()->getProfiles() as $profile)
                            <option value="{!! $profile->id !!}" {!! $profile->id == \Request::get('profile') ? 'selected':'' !!}>{!! $profile->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right"><i
                                        class="fa fa-search"></i> {!! tr('search') !!}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


    <div class="col-md-12">
        <h4 class="text-center" id="loading" style="display: none"><i
                    class="fa fa-spinner fa-spin"></i> {!! tr('loading') !!}...
        </h4>
        <div id="posts"></div>
    </div>

@stop

@section('js')

    <script src="{!!url('assets')!!}/js/jquery-ui.min.js"></script>
    <script>
        $("#date_from").datepicker({
            maxDate: "+0",
            onSelect: function (selectedDate) {
                $("#date_to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#date_to").datepicker({
            onSelect: function (selectedDate) {
                $("#date_from").datepicker("option", "maxDate", selectedDate);
            }
        });
        function load_posts(date_from, date_to, profile) {
            $("#posts").html("");
            $("#loading").show();
            $.ajax({
                type: 'GET',
                url: '{!! route('posts.get') !!}',
                data: {
                    date_from: date_from,
                    date_to: date_to,
                    profile: profile
                }
            }).done(function (data) {
                $("#loading").hide();
                $("#posts").html(data);
            });
        }
        $("#search").submit(function (e) {
            e.preventDefault();
            load_posts($("#date_from").val(), $("#date_to").val(), $("#profile").val());
        });
        load_posts("", "", 0);
    </script>

@stop