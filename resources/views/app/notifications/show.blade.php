@extends('app.layouts.main')

@section('title')
    {!! $notification->title !!}
@stop

@section('content')
    <h3 align="center">{!! $notification->title !!}</h3>
    <p align="center">{!! $notification->description !!}</h3>
@stop