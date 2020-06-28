@extends('layouts.masterback')
@section('title', 'Settings: '.defaultsettings()['sitename'])
@section('heading', 'Settings')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Settings</h4></div>
        <div class="panel-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif
            @if(session('status'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong> {{ session('status') }}</strong>
                </div>
            @endif

            <div class="row" style="padding: 10px;">
                <div class="col-md-4">                    
                    @include('settings.bidding')
                </div>
                {{-- <div class="col-md-4">
                    @include('settings.notifications')
                </div> --}}
                <div class="col-md-4">
                    @include('settings.main')
                </div>
                <div class="col-md-4">
                    @include('settings.commissions')
                </div>
            </div>
        </div>
    </div>
</div>
@stop
