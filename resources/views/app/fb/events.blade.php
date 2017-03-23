@extends('app.layouts.main')

@section('title')
    Избери Фейсбук Събитие
@stop


@section('content')
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="card-box">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Име на събитието</th>
                        <th class="col-md-2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($profiles as $profile)
                        <?php
                        $fb->setDefaultAccessToken($profile->access_token);
                        $res = $fb->get('/me/events');
                        $groups = json_decode($res->getBody(), true);
                        ?>
                        @foreach($groups["data"] as $group)
                            <tr>
                                <td style="vertical-align: middle;">{!! $group['name'] !!}</td>

                                <td style="vertical-align: middle;">
                                    {!! Form::open(['url' => 'app/connect/fb_event']) !!}
                                    <input type="hidden" name="info[id]" value="{!! $group['id'] !!}">
                                    <input type="hidden" name="info[name]" value="{!! $group['name'] !!}">
                                    <input type="hidden" name="info[access_token]"
                                           value="{!! $profile->access_token !!}">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                                        Свържи
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop