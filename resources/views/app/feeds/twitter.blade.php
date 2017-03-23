@extends('app.layouts.main')

@section('title')
    Twitter
@stop



@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{!! route('feeds') !!}" class="list-group-item list-group-item-twitter"
                   style="background-color: rgba(43, 178, 76, 0.5)">
                    <h4 class="list-group-item-heading" style="color:rgba(0,0,0,0.5)"><i class="fa fa-rss"></i>
                        Feedly</h4>
                    <p style="color:rgba(0,0,0,0.5)" class="list-group-item-text">Свържи акаунта си в Feedly и
                        управлявай всички новини </p>
                </a>
                <a href="#" class="list-group-item list-group-item-twitter"
                   style="background-color: rgba(106, 197, 255, 0.9)">
                    <h4 class="list-group-item-heading" style="color:rgba(0,0,0,0.5)"><i class="fa fa-twitter"></i>
                        Twitter
                    </h4>
                    <p style="color:rgba(0,0,0,0.5)" class="list-group-item-text">Виж последните новини в Twitter</p>
                </a>
            </div>
        </div>
        <div class="col-md-9">
            <h3 class="text-center"><i class="fa fa-twitter"></i> Twitter Новини</h3>
            @if($twitterAccount == null)
                <a href="{!! route('connect.twitter') !!}" class="btn btn-info"><i class="fa fa-twitter"></i> Свържи
                    твоя Twitter акаунт</a>
            @else
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @foreach($feeds as $feed)
                            <div class="card-box" style="padding:10px;">
                                <a href="{!! $feed['user']['url'] !!}"><img
                                            src="{!! $feed['user']['profile_image_url'] !!}" height="30">
                                    <strong>{!! $feed['user']['name'] !!}</strong></a>
                                <div class="pull-right">
                                    <i class="fa fa-clock-o"></i>
                                    {!! Twitter::ago(strtotime($feed['created_at'])) !!}
                                </div>
                                <p>{!! $feed['text'] !!}</p>
                                @if(isset($feed['extended_entities']))
                                    @if(count($feed['extended_entities']['media']))
                                        @if($feed['extended_entities']['media'][0]['type'] == "photo")
                                            <img src="{!! $feed['extended_entities']['media'][0]['media_url'] !!}"
                                                 class="img-thumbnail">
                                        @endif
                                    @endif
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop