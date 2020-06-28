@extends('layouts.masterback')
@section('title', 'Dashboard: '.defaultsettings()['sitename'])
@section('heading', 'Dashboard')
@section('content')
	@if (session('status'))
	    <div class="alert alert-success">
	        <strong>{{ session('status') }}</strong>
	    </div>
	@endif
	@if (session('error'))
	    <div class="alert alert-danger">
	        <strong>{{ session('error') }}</strong>
	    </div>
	@endif
	<div class="col-lg-8">
		@include('tutor.home.findorders')
		@include('tutor.home.recentorders')
		@include('tutor.home.disputeorders')
	</div>
	<div class="col-lg-4">
		@include('tutor.home.stats')
		@include('tutor.home.notificationpanel')
	</div>
@stop
