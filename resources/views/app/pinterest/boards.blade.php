@extends('app.layouts.main')

@section('title')
    Pinterest Boards
@stop


@section('content')
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Your Pages</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th class="col-md-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($boardsArray as $board)
                            <tr>
                                <td style="vertical-align: middle;font-weight:bold;font-size:17px;">{!! $board['name'] !!}</td>

                                <td style="vertical-align: middle;">
                                    {!! Form::open(['url' => 'app/connect/pinterest_board']) !!}
                                    <input type="hidden" name="info[id]" value="{!! $board['id'] !!}">
                                    <input type="hidden" name="info[name]" value="{!! $board['name'] !!}">
                                    <input type="hidden" name="info[image]" value="{!! $board['image'] !!}">
                                    <input type="hidden" name="info[profile]" value="{!! $board['profile'] !!}">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Connect
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">There are no boards</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop