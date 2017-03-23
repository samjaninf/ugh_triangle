@extends('admin.layout.main')

@section('title')
    {!! tr('create_user') !!}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">{!! tr('create_user') !!} </h4>

            <p class="text-muted page-title-alt"></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="portlet">
                <div class="portlet-heading bg-success">
                    <h3 class="portlet-title">
                        {!! tr('create_user') !!}
                    </h3>

                    <div class="clearfix"></div>
                </div>
                <div id="bg-success" class="panel-collapse collapse in">
                    {!! Form::open(['url' => 'admin/users']) !!}
                    <div class="portlet-body">
                        <strong>{!! tr('first_name') !!}</strong>
                        <input type="text" name="fname" class="form-control">
                        <strong>{!! tr('last_name') !!}</strong>
                        <input type="text" name="lname" class="form-control">
                        <strong>E-mail</strong>
                        <input type="text" name="email" class="form-control">
                        <strong>{!! tr('password') !!}</strong>
                        <input type="password" name="password" class="form-control"><br>
                        <label>
                            <input type="checkbox" name="is_admin" class="checkbox-primary">
                            {!! tr('is_admin') !!}
                        </label>
                    </div>
                    <div class="portlet-footer text-center">
                        <button type="submit" class="btn btn-primary">{!! tr('create') !!}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
@stop