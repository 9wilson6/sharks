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
        @include('student.home.postorders')
        @include('student.home.recentorders')
        @include('student.home.disputeorders')
    </div>
    <div class="col-lg-4">
        @include('student.home.stats')
    </div>
@stop