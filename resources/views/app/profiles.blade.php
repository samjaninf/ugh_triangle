@extends('app.layouts.main')

@section('title')
    {!! trans('messages.manage_profiles') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <select class="form-control">
                <option value="0">Facebook</option>
            </select>
        </div>
    </div>

@stop