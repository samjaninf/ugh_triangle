@extends('app.layouts.main')

@section('title')
    RSS емисии
@stop



@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-twitter"
                   style="background-color: rgba(43, 178, 76, 0.7)">
                    <h4 class="list-group-item-heading" style="color:rgba(0,0,0,0.5)"><i class="fa fa-rss"></i>
                        Feedly</h4>
                    <p style="color:rgba(0,0,0,0.5)" class="list-group-item-text">Свържи акаунта си в Feedly и
                        управлявай всички новини </p>
                </a>
                <a href="{!! route('feeds.twitter') !!}" class="list-group-item list-group-item-twitter"
                   style="background-color: rgba(106, 197, 255, 0.6)">
                    <h4 class="list-group-item-heading" style="color:rgba(0,0,0,0.5)"><i class="fa fa-twitter"></i>
                        Twitter
                    </h4>
                    <p style="color:rgba(0,0,0,0.5)" class="list-group-item-text">Виж последните новини в Twitter</p>
                </a>
            </div>
        </div>
        <div class="col-md-9">
            <h3 class="text-center"><i class="fa fa-rss"></i> Feedly</h3>
            <a href="{!! route('feedly.connect') !!}">Feedly Connect</a>
        </div>
    </div>
@stop