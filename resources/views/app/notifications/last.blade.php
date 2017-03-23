@forelse($nots as $not)
    <a href="{!! $not->link !!}"
       class="list-group-item notification"
       is-seen="{!! $not->is_read !!}"
       not-id="{!! $not->id !!}">
        <div class="media">
            <div class="pull-left p-r-10">
                <em class="fa fa-{!! $not->icon !!} fa-2x text-success"></em>
            </div>
            <div class="media-body">
                <h5 class="media-heading">{!! $not->title !!}</h5>
                <p class="m-0">
                    <small>{!! $not->description !!}</small>
                </p>
            </div>
        </div>
    </a>
@empty
    <div class="text-center">
        <p style="color:#777;margin:10px;">{!! tr('you_do_not_have_any_nots') !!}</p>
    </div>
@endforelse
<script>
    $(".notification").mouseover(function () {
        var el = $(this);
        if (el.attr("is-seen") == 0) {
            el.attr("is-seen", 1);
            $.get('{!! route('app.notification.seen') !!}', {id: $(this).attr("not-id")}, function () {
                var text = parseInt($(".nots_count").first().text());
                if (text > 0) text--;
                $(".nots_count").text(text);
            });
        }
    });
</script>