@extends('app.layouts.main')

@section('title')
    {!! tr("connect") !!}
@stop


@section('content')
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="card-box">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{!! tr("name") !!}</th>
                        <th class="col-md-2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($pages[0]['data'] as $group)
                        <tr>
                            <td style="vertical-align: middle;">{!! $group['name'] !!}</td>

                            <td style="vertical-align: middle;">
                                {!! Form::open(['url' => 'app/connect/fb_page']) !!}
                                <input type="hidden" name="info[id]" value="{!! $group['id'] !!}">
                                <input type="hidden" name="info[name]" value="{!! $group['name'] !!}">
                                <input type="hidden" name="info[access_token]"
                                       value="{!! $group['access_token'] !!}">
                                <button type="submit" class="btn btn-success"><i
                                            class="fa fa-check"></i> {!! tr("connect") !!}
                                </button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">Нямаш никакви фейсбук страници свързани към твоят ФБ акаунт</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop