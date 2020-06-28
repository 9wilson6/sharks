@extends('layouts.masterback')
@section('title', 'Dashboard: '.defaultsettings()['sitename'])
@section('heading', 'Dashboard & Money Management')
@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Orders assigned to writers/In progress</h4></div>
            <div class="panel-body">
                @include('dashboard.inprogress')
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h4>Orders awaiting assign</h4></div>
            <div class="panel-body">
                @include('dashboard.pendingorders')
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h4>Recent manual releases request</h4></div>
            <div class="panel-body">
                @include('dashboard.manualrelease')
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h4>Suspended tutor accounts</h4></div>
            <div class="panel-body">
                @include('dashboard.suspended')
            </div>
        </div>

    </div>
</div>
@stop
