@extends('app.layouts.main')

@section('title')
    {!! tr("settings") !!}
@stop

@section('content')
    <div class="row">
    <!-- <div class="col-sm-4 col-sm-offset-2">
            {!! Form::open(['url' => 'app/settings']) !!}
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{!! tr("settings") !!}</h3>
                </div>
                <div class="panel-body" style="height: 150px;">
                    <strong>Име</strong>
                    <input type="text" class="form-control" name="name" value="{!! \Auth::user()->name !!}">
                    <strong>E-mail</strong>
                    <input type="text" class="form-control" name="email" value="{!! \Auth::user()->email !!}">
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary btn-block"><i
                                class="fa fa-refresh"></i> {!! tr("update") !!}</button>
                </div>
            </div>
            {!! Form::close() !!}
            </div> -->
        <div class="col-sm-4 col-sm-offset-4">
            {!! Form::open(['url' => 'app/change_password']) !!}
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">{!! tr("change_your_password") !!}</h3>
                </div>
                <div class="panel-body" style="height: 150px;">
                    <strong>{!! tr("new_password") !!}</strong>
                    <input type="password" class="form-control" name="new_password">
                    <strong>{!! tr("confirm_new_password") !!}</strong>
                    <input type="password" class="form-control" name="c_new_password">
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success btn-block"><i
                                class="fa fa-refresh"></i> {!! tr("update") !!}</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop