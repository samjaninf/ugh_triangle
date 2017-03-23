@foreach($drafts as $draft)
    <a href="#" class="list-group-item loadItem">
        <h4 class="list-group-item-heading">{!! $draft->created_at !!} [<i
                    class="fa fa-user"></i> {!! $draft->user->name !!}]</h4>
        <p class="list-group-item-text">{!! substr($draft->text,0,300).(mb_strlen($draft->text,"utf-8")>300?"...":"") !!}</p>
    </a>
@endforeach
