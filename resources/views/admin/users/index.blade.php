@extends('admin.layout.main')

@section('title')
    {!! trans('messages.users') !!}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Users </h4>
        </div>
    </div>
    <a href="{!! url('admin/users/create') !!}" class="btn btn-success">{!! trans('messages.add_new') !!}</a>
    <table class="table table-hover table-striped table-border">
        <thead>
        <tr>
            <th>E-mail</th>
            <th>{!! trans('messages.name') !!}</th>
            <th>{!! trans('messages.date_registered') !!}</th>
            <th>{!! trans('messages.options') !!}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{!! $user->email !!} {!!$user->is_admin ? "[ADMIN]":""!!}</td>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->created_at !!}</td>
                <td>
                    <div class="btn-group">
                        @if($user->is_admin==0)
                            <a href="{!! url('admin/users/'.$user->id.'/edit') !!}" class="btn btn-success btn-sm"><i
                                        class="fa fa-edit"></i></a>
                            <a href="#deleteModal{!! $user->id !!}" class="btn btn-danger btn-sm" data-toggle="modal"><i
                                        class="fa fa-times"></i></a>
                        @endif
                    </div>
                </td>
            </tr>
        @empty

        @endforelse
        </tbody>
    </table>

    {!! $users->render() !!}
@stop

@section('js')
    @foreach($users as $user)
        @if($user->is_admin == 0)
            <div class="modal fade" id="deleteModal{!! $user->id !!}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">{!! tr('are_you_sure') !!}</h4>
                        </div>
                        <div class="modal-body">
                            {!! trans('messages.confirm_delete_user') !!}?
                            </ul>
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['url' => 'admin/users/'.$user->id, 'method' => 'DELETE', 'id' => 'delForm'.$user->id]) !!}
                            <button type="button" class="btn btn-success"
                                    data-dismiss="modal">{!! trans('messages.no') !!}</button>
                            <button type="submit" class="btn btn-danger">{!! tr('yes') !!}</button>
                            {!! Form::close() !!}
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @endif
    @endforeach
@stop