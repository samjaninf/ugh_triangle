@extends('app.layouts.main')

@section('title')
    {!! tr("connect_profile") !!}
@stop


@section('content')
    <table class="table table-hover table-bordered table-striped">
        <thead>
        <tr>
            <th>{!! tr("name") !!}</th>
            <th class="col-md-2"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($profiles as $profile)
            <?php
            $fb->setDefaultAccessToken($profile->access_token);
            $res = $fb->get('/me/groups');
            $groups = json_decode($res->getBody(), true);
            $groups = array_where($groups["data"], function ($key, $value) {
                return $value["privacy"] == "OPEN" ? 1 : 0;
            });
            ?>
            @foreach($groups as $group)
                <tr>
                    <td style="vertical-align: middle;">{!! $group['name'] !!}</td>

                    <td style="vertical-align: middle;">
                        {!! Form::open(['url' => 'app/connect/fb_group']) !!}
                        <input type="hidden" name="info[id]" value="{!! $group['id'] !!}">
                        <input type="hidden" name="info[name]" value="{!! $group['name'] !!}">
                        <input type="hidden" name="info[access_token]" value="{!! $profile->access_token !!}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                            {!! tr("connect") !!}
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
@stop
