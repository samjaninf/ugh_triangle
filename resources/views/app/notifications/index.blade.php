@extends('app.layouts.main')

@section('title')
    {!! tr('notifications') !!}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card-box">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>{!! tr('title') !!}</th>
                        <th>{!! tr('date') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($nots as $notification)
                        {!! $notification->seen() !!}
                        <tr>
                            <td><i class="fa fa-{!! $notification->icon !!}"></i> <a href="{!! $notification->link !!}"
                                                                                     style="{!! $notification->is_read?"":'font-weight:bold;' !!}">{!! $notification->title !!}</a>
                            </td>
                            <td style="{!! $notification->is_read?"":'font-weight:bold;' !!}">{!! $notification->created_at !!}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">
                                <i class="fa fa-info"></i> {!! tr('you_have_no_notifications') !!}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {!! $nots->render() !!}
            </div>
        </div>
    </div>

@stop