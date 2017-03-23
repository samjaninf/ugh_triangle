<div id="portlet2" class="panel-collapse collapse in">
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Post Description</th>
                    <th>Publish Date</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{!! $post->id !!}</td>
                        <td>{!! $post->content !!}</td>
                        <td>{!! date("Y-m-d H:i:s", $post->time) !!}</td>
                        <td>{!! $post->profile->getNameType() !!}</td>
                        <td>
                            <span class="label label-{!! $post->published?"success":"info" !!}">{!! $post->published?trans("messages.published"):trans("messages.scheduled") !!}</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{!! url('app/post/'.$post->id.'/delete') !!}" class="btn btn-danger btn-sm"><i
                                            class="fa fa-times"></i></a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <i class="fa fa-coffee"></i>
                            {!! trans('messages.there_are_no_posts') !!}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>