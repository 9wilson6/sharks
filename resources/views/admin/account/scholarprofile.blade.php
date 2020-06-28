@extends('layouts.masterback')
@section('title', 'Homework Bubble: Dashboard')
@section('heading', 'Scholar Profile')
@section('content')
	@if (session('error'))
		<div class="alert alert-danger">
			<strong>{{ session('error') }}</strong>
		</div>
	@endif
	@if (session('status'))
		<div class="alert alert-success">
			<strong>{{ session('status') }}</strong>
		</div>
	@endif
    <div class="col-lg-4">
        @include('admin.account.scholar.details')
	</div>
	<div class="col-lg-8">
		@include('admin.account.scholar.about')
		@include('admin.account.scholar.documents')
	    @include('admin.account.scholar.contact')
	    @include('admin.account.scholar.reviews')
	</div>
@stop
