@extends('app.layouts.main')

@section('title')
    {!! \Route::current()->getPath()=='app/watermark'?'Watermark':'Predefined Times' !!}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{!! tr("publish_times") !!}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th class="col-md-2">Профил</th>
                            <th>Име</th>
                            <th class="col-md-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($profiles as $profile)
                            <tr>
                                <td class="text-center"><img src="{!! $profile->avatar !!}" width="50" alt=""></td>
                                <td>{!! $profile->name !!}</td>
                                <td>
                                    <a href="{!! url('app/'.(\Route::current()->getPath()=='app/watermark'?'watermark':'ptimes').'/'.$profile->id) !!}"
                                       class="btn btn-primary"><i class="fa fa-pencil"></i> Редактирай</a></td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop