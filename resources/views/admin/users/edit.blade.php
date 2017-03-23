@extends('admin.layout.main')

@section('title')
    {!! tr('edit_user') !!}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">{!! tr('edit_user') !!} </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="portlet">
                <div class="portlet-heading bg-success">
                    <h3 class="portlet-title">
                        {!! tr('edit_user') !!}
                    </h3>

                    <div class="portlet-widgets">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-success" class="panel-collapse collapse in">
                    {!! Form::open(['url' => 'admin/users/'.$user->id,'method' => "PUT"]) !!}
                    <div class="portlet-body">
                        <strong>{!! tr('name') !!}</strong>
                        <input type="text" name="name" class="form-control" value="{!! $user->name !!}">
                        <strong>E-mail</strong>
                        <input type="text" name="email" class="form-control" value="{!! $user->email !!}">
                        <strong>{!! tr('password') !!}</strong>
                        <input type="password" name="password" class="form-control"><br>
                        <label>
                            <input type="checkbox" name="is_admin"
                                   class="checkbox-primary" {!! $user->is_admin ? "checked='checked'":"" !!}>
                            {!! tr('is_admin') !!}
                        </label>
                    </div>
                    <div class="portlet-footer text-center">
                        <button type="submit" class="btn btn-primary">{!! tr('update') !!}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
@stop