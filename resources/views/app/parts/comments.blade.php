<strong>{!! tr("comments") !!}</strong>
<table class="table table-hover table-striped">
    <tbody>
    @forelse($comments as $comment)
        <tr>
            <td><strong>{!! $comment["from"]["name"] !!}</strong> <i
                        class="fa fa-clock-o"></i> {!! date("Y-m-d H:i",strtotime($comment['created_time'])) !!}
                <br>{!! $comment["message"] !!}
                <br>
            </td>
        </tr>
    @empty
        <tr>
            <td>There are no comments</td>
        </tr>
    @endforelse
    <tr>
        <td>
            <input type="text" class="form-control comment" placeholder="Comment..."
                   p-id="{!! $post->post_id !!}" post-id="{!! $post->id !!}">
        </td>
    </tr>
    </tbody>
</table>
<script>
    $(".comment").keyup(function (e) {
        var element = $(this);
        if (e.keyCode == 13) {
            var val = $(".comment").val();
            $(".comment").val("Posting...");
            $(".comment").attr("disabled", "disabled");
            $.get('{!! url('app/comment/create') !!}', {
                post_id: element.attr("p-id"),
                comment: val
            }, function () {
                $(".comment").val("Reloading...");
                sweetAlert("{!! tr('success')!!}", "The comment is posted successfully", "success");
                loadComment(element.attr("post-id"), $(".comments[p-id=" + element.attr("post-id") + "]"));
            });
        }
    });</script>