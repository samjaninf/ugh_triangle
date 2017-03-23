@extends('app.layouts.main')

@section('title')
    {!! tr("watermark") !!}
@stop

@section('css')
    <link rel="stylesheet" href="{!! url('assets') !!}/css/jquery.fileupload.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <style>
        .pos {
            border-radius: 0px;
            width: 84px;
            font-size: 10px;
        }
    </style>

@stop

@section('content')
    <style type="text/css">
        .watermark {
            border: 2px dashed #000;
        }

        img.watermark:hover {
            cursor: move;
        }
    </style>
    <div class="panel panel-border panel-custom">
        <div class="panel-heading">
            <h3 class="panel-title">{!! tr("watermark") !!}</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['url' => 'app/watermark/'.$profile->id, 'files' => true, 'id' => 'form']) !!}
            <strong>{!! tr("upload_picture") !!}</strong>
            <input type="file" name="file" onchange="$('#form').submit()">
            {!! Form::close() !!}


            @if(\Request::has('img'))
                {!! Form::open(['url' => 'app/watermark/'.$profile->id.'/update']) !!}
                <input type="hidden" name="img[src]" value="{!! \Request::get('url') !!}">
                <input type="hidden" id="paddings" name="img[paddings]" value=""/>
                <input type="hidden" id="w" name="img[width]" value=""/>
                <input type="hidden" id="widthPerc" name="img[width_perc]" value=""/>
                <input type="hidden" id="h" name="img[height]" value=""/>
                <input type="hidden" id="opacity" name="img[opacity]" value=""/>
                <div style="margin-top: 50px;">
                    <div class="row">
                        <div class="col-sm-4" style="margin:30px 0px;">
                            <strong>{!! tr("opacity") !!}</strong>
                            <div id="slider"></div>
                        </div>
                    </div>
                </div>
                <img src="{!! url('assets/global/img/618182.jpg') !!}" width="800" height="600" id="watermarked"><br>
                <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> {!! tr("update") !!}
                </button>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
@stop

@section('js')

    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"
            integrity="sha256-xI/qyl9vpwWFOXz7+x/9WkG5j/SVnSw21viy8fWwbeE=" crossorigin="anonymous"></script>
    <script src="{!! url('assets') !!}/js/jquery.iframe-transport.js"></script>
    <script src="{!! url('assets') !!}/js/jquery.fileupload.js"></script>
    <script src="{!! url('assets') !!}/js/watermark-move.min.js"></script>
    @if(\Request::has('img'))
        <script>
            var paddings = {
                top: 0,
                left: 0,
                bottom: 0,
                right: 0
            };
            function showCoords(c) {
                paddings.top = c.y;
                paddings.left = c.x;
                $('#w').val(c.w);
                $('#h').val(c.h);
                $("#widthPerc").val($("#w").val() / 800);
                $('#opacity').val(c.opacity);
                $("#paddings").val(JSON.stringify(paddings));
            }
            $('#watermarked').Watermarker({
                watermark_img: '{!! \Request::get('url') !!}',
                opacitySlider: $("#slider"),
                opacity: '{!! \Request::has('opacity')?\Request::get('opacity')/100:1 !!}',
                @if(\Request::has('x') && \Request::has('y'))
                x: {!! \Request::get('x')!!},
                y: {!! \Request::get('y')!!},
                @endif
                w: '{!! \Request::has('width')?\Request::get('width'):80 !!}',
                h: '{!! \Request::has('height')?\Request::get('height'):(80/\Request::get('ratio')) !!}',
                position: 'topleft',
                onChange: showCoords
            });
        </script>
    @endif
    <script>

    </script>
@stop