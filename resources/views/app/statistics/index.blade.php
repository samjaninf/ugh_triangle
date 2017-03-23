@extends('app.layouts.main')

@section('title')
    {!! tr('statistics') !!}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <select class="form-control" name="profile" id="sel">
                <option value="0">{!! tr('select_profile') !!}</option>
                @foreach($profiles as $profile)
                    <option value="{!! $profile->id !!}">
                        {!! $profile->name !!} [{!! $profile->getNameType() !!}]
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="row" style="margin-top:20px;">
            <div class="col-sm-8 col-sm-offset-2">
                <h4 class="text-center" style="display: none" id="loading"><i
                            class="fa fa-spinner fa-spin"></i> {!! tr('loading') !!}...</h4>
                <div id="stats_area">

                </div>

            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.1/Chart.js"></script>
    <script>
        $("#sel").change(function () {
            $("#stats_area").html("");
            $("#loading").show();
            if ($("#sel").val() != "0")
                $.ajax({
                    type: 'get',
                    url: '{!!  route('statistics.show') !!}',
                    timeout: 10000,
                    data: {
                        profile: $("#sel").val()
                    }
                }).done(function (data) {
                    $("#loading").hide();
                    $("#stats_area").html(data);
                });
        });
    </script>
@stop