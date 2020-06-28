@extends('layouts.masterback')
@section('title', 'Homework Bubble: Dashboard')
@section('heading', 'Scholar Profile')
@section('content')
    <div class="col-lg-4">
    @include('tutor.account.scholar.details')
	    <!-- Ends Panel -->
	</div>
	<!--Ends Column-->
	<div class="col-lg-8">
	    @include('tutor.account.scholar.about')
	    @include('tutor.account.scholar.contact')
	    @include('tutor.account.scholar.reviews')
	</div>
@stop