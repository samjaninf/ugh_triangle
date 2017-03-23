@if(count($posts))
    <section id="cd-timeline" class="cd-container">
        @foreach($posts as $post)
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-success">
                    <i class="{!! $post->profile->getIcon() !!}"></i>
                </div> <!-- cd-timeline-img -->

                <div class="cd-timeline-content">
                    <h3>{!! $post->profile->name !!} </h3>
                    {!! $post->published ? "<i class='fa fa-check'></i>Posted at": "<i class='fa fa-paper-plane'></i> Scheduled for" !!}
                    <p>{!! $post->content !!}</p>
                    <span class="cd-date">{!! date("Y-m-d H:i:s", $post->time) !!}</span>
                    @if($post->profile->hasComments() && $post->published)
                        <div class="comments" p-id="{!! $post->id !!}"></div>

                    @endif
                    <hr>
                    @if($post->profile->isFacebook() && $post->published)
                        <span style="cursor: default" class="btn btn-success btn-xs">
                            <strong><i class="fa fa-thumbs-up"></i> {!! $post->getApiData("likes",null) !!}</strong>
                        </span>
                    @endif
                    <a href="javascript:;" ajax="ajax" data-parent-lever-hide="2"
                       data-success="Публикацията е изтрита успешно"
                       data-href="{!! route('post.delete',$post->id) !!}" class="btn btn-danger btn-sm pull-right"><i
                                class="fa fa-trash-o"></i> {!! tr("delete") !!}</a>
                </div> <!-- cd-timeline-content -->
            </div> <!-- cd-timeline-block -->
        @endforeach

        {!! $posts->render() !!}
    </section> <!-- cd-timeline -->
@else
    <h4 align="center"><i class="fa fa-search"></i> {!! tr('no_posts_found') !!}</h4>
@endif
<script>
    $("a[ajax=ajax]").click(function () {
        var success_message = $(this).attr("data-success");
        var el = $(this);
        $(this).addClass('disabled');
        $(this).text("{!! tr('processing')!!}...");
        $.get($(this).attr("data-href"), function () {
            sweetAlert("Ура", success_message, "success");
            el.parent().parent().hide();
        });
    });
    function loadComment(postId, element) {
        element.html("{!! tr('loading') !!}...");
        $.get('{!! url('app/comments/load')!!}', {id: postId}, function (data) {
            element.html(data);
        });
    }
    $(".comments").each(function () {
        loadComment($(this).attr("p-id"), $(this));

    });

</script>