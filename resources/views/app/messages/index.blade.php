@extends('app.layouts.main')

@section('title')
    Съобщения
@stop

@section('content')
    <div class="row">

        <!-- Left sidebar -->
        <div class="col-lg-3 col-md-4">

            <div class="p-20">
                <a href="{!! route('messages.create') !!}"
                   class="btn btn-danger btn-rounded btn-custom btn-block waves-effect waves-light">Ново съобщение</a>
                <div class="list-group mail-list  m-t-20">
                    <a href="#" class="list-group-item b-0 active"><i class="fa fa-download m-r-10"></i>Входящи
                        <b>(8)</b></a>
                    <a href="#" class="list-group-item b-0"><i class="fa fa-star-o m-r-10"></i>Важни</a>
                    <a href="#" class="list-group-item b-0"><i class="fa fa-paper-plane-o m-r-10"></i>Изпратени</a>
                    <a href="#" class="list-group-item b-0"><i class="fa fa-trash-o m-r-10"></i>Кошче <b>(354)</b></a>
                </div>


            </div>

        </div>
        <!-- End Left sidebar -->

        <!-- Right Sidebar -->
        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar m-t-20" role="toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary waves-effect waves-light "><i
                                        class="fa fa-inbox"></i></button>
                            <button type="button" class="btn btn-primary waves-effect waves-light "><i
                                        class="fa fa-exclamation-circle"></i></button>
                            <button type="button" class="btn btn-primary waves-effect waves-light "><i
                                        class="fa fa-trash-o"></i></button>
                        </div>
                    </div>
                </div>
            </div> <!-- End row -->

            <div class="panel panel-default m-t-20">
                <div class="panel-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mails m-0">
                            <tbody>
                            <tr class="unread">
                                <td class="mail-select">
                                    <div class="checkbox checkbox-primary m-r-15">
                                        <input id="checkbox1" type="checkbox">
                                        <label for="checkbox1"></label>
                                    </div>

                                    <i class="fa fa-star m-r-15 text-muted"></i>

                                </td>

                                <td>
                                    <a href="apps-email-read.html" class="email-name">Google Inc</a>
                                </td>

                                <td class="hidden-xs">
                                    <a href="apps-email-read.html" class="email-msg">Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit</a>
                                </td>
                                <td class="text-right">
                                    07:23 AM
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>

                </div> <!-- panel body -->
            </div>


        </div> <!-- end Col-9 -->

    </div>
@stop