@extends('app.layouts.main')

@section('title')
    Bit.ly
@stop

@section('content')
    @if(count($profiles))
        <h3 align="center">{!! tr("your_profiles") !!}</h3>
    @endif
    <div class="row" style="margin-bottom: 30px;">
        <div class="col-sm-4 col-sm-offset-4">
            <a href="{!! url("app/connect/bitly/all") !!}" class="btn btn-success btn-block"><i
                        class="fa fa-search"></i> {!! tr("connect_all") !!}</a>
        </div>
    </div>
    @forelse($profiles as $profile)
        @if($profile->getNameType())
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">{!! $profile->name !!} [{!! $profile->getNameType() !!}]</h3>
                        </div>
                        <div class="panel-body">
                            @if($profile->bitly()->first()!=null)
                                <p>Bitly Profile: {!! $profile->bitly()->first()->bitly_id !!}</p>
                                <a href="{!! url("app/disconnect/bitly/{$profile->id}") !!}"
                                   class="btn btn-primary">{!! tr("disconnect") !!}</a>
                            @else
                                <a href="{!! url("app/preconnect/bitly/{$profile->id}") !!}"
                                   class="btn btn-primary">{!! tr("connect") !!}</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <h3 align="center"><i
                            class="fa fa-meh-o"></i> {!! tr("you_have_no_connected_profiles_to_your_account") !!}</h3>
            </div>
        </div>
    @endforelse
@stop