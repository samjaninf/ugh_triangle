<table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>
        <th>{!! trans('messages.name') !!}</th>
        <th class="col-md-2"></th>
    </tr>
    </thead>
    <tbody>
    @if(!count($pages))
        <tr>
            <td colspan="2">{!! trans('messages.you_dont_have_associated_pages') !!}</td>
        </tr>
    @else
        @foreach($pages as $group)
            <tr>
                <td style="vertical-align: middle;font-weight:bold;font-size:17px;">{!! $group['name'] !!}</td>

                <td style="vertical-align: middle;">
                    {!! Form::open(['url' => 'app/connect/linkedin_page']) !!}
                    <input type="hidden" name="info[id]" value="{!! $group['id'] !!}">
                    <input type="hidden" name="info[name]" value="{!! $group['name'] !!}">
                    <input type="hidden" name="info[p_id]" value="{!! $group['p_id'] !!}">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                        {!! trans('messages.connect') !!}
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>
