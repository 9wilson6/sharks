@extends('layouts.masterback')
@section('title', 'Edit Pusher: '.defaultsettings()['sitename'])
@section('heading', 'Edit Pusher')
@section('content')
    <div class="col-lg-6">
        @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="post" action="{{ route('admin.savepusher') }}">
    {{ csrf_field() }}
        <input type="text" class="input-lg form-control" name="app_id" value="{{ $push['app_id'] }}" placeholder="Pusher App ID" autocomplete="off">
        <div class="row"></div>
        <input type="text" class="input-lg form-control" name="app_key" value="{{ $push['app_key'] }}" placeholder="Pusher App Key" autocomplete="off">
        <div class="row"></div>
        <input type="text" class="input-lg form-control" name="app_secret" value="{{ $push['app_secret'] }}" placeholder="Pusher App Secret" autocomplete="off">
        <div class="row"></div>
        <input type="text" class="input-lg form-control" name="app_cluster" value="{{ $push['app_cluster'] }}" placeholder="Pusher App Cluster" autocomplete="off">
        <div class="row"></div>
        <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" value="Change Pusher Details">
    </form>
    </div>
@stop
