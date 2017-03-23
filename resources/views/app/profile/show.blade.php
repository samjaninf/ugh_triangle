@extends('app.layouts.main')

@section('title')
    {!! $profile->name !!}
@stop

@section('content')
    <div class="wraper container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="bg-picture text-center">
                    <div class="bg-picture-overlay"></div>
                    <div class="profile-info-name">
                        <img src="{!! $profile->avatar !!}" class="thumb-lg img-circle img-thumbnail"
                             alt="profile-image">
                        <h4 class="m-b-5"><b>{!! $profile->name !!}</b></h4>

                        <p class="text-muted"><i class="fa fa-bullhorn"></i> {!! $profile->getNameType() !!}</p>
                    </div>
                </div>
                <!--/ meta -->
            </div>
        </div>


        <div class="row">
            <div class="col-md-4">

                <!-- Personal-Information -->
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b> {!! tr("edit_profile") !!}</b></h4>
                    {!! Form::open(['route' => ['profile.update', $profile->id]]) !!}
                    <strong>{!! tr("name") !!}</strong>
                    <input type="text" class="form-control" name="name" value="{!! $profile->name !!}">
                    <strong>{!! tr("description") !!}</strong>
                    <textarea name="description" class="form-control" rows="10">{!! $profile->description !!}</textarea>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <a class="btn btn-danger" data-toggle="modal" href="#delete_profile"><i
                                        class="fa fa-trash-o"></i> {!! tr("delete") !!}</a>
                            <div class="modal fade" id="delete_profile">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">{!! tr("delete_profile") !!}</h4>
                                        </div>
                                        <div class="modal-body">
                                            {!! tr("do_you_really_want_to_delete_p") !!}
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" data-dismiss="modal"
                                               class="btn btn-primary">{!! tr("no") !!}</a>
                                            <a href="{!! route('profile.delete', $profile->id) !!}"
                                               class="btn btn-danger"><i
                                                        class="fa fa-trash-o"></i> {!! tr("yes") !!}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <button type="submit" class="btn btn-primary pull-right"><i
                                        class="fa fa-refresh"></i> {!! tr("update") !!}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <a href="{!! url('app/watermark/'.$profile->id) !!}" class="btn btn-primary">
                    <i class="fa fa-wrench"></i> {!! tr("watermark_settings") !!}
                </a>
                <!-- Personal-Information -->


                <!-- Personal-Information -->


            </div>


            <div class="col-md-8">

                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b>{!! tr("activity") !!}</b></h4>

                    <div class="p-20">
                        <div class="timeline-2">
                            @forelse($posts as $post)
                                <div class="time-item">
                                    <div class="item-info">
                                        <div class="text-muted">{!! \Carbon\Carbon::createFromTimeStamp($post->time)->diffForHumans() !!}</div>
                                        <p><strong><a href="#"
                                                      class="text-info">{!! $post->getTypeName() !!}</a></strong> {!! $post->content !!}
                                            @if($post->getType() == "image")
                                                @foreach(json_decode($post->images) as $image)
                                                    <br><span><a href="{!! $image !!}">{!! $image !!}</a></span>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">
                                    <i class="fa fa-info"></i> {!! tr("there_is_no_activity") !!}
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>

            </div>


        </div>

        <div class="row">

        </div>
    </div>
@stop