@extends('layouts.masterback')
@section('title', 'Homework Bubble: Dashboard')
@section('heading', 'Scholar Profile')
@section('content')
    <div class="col-lg-4">
    @include('student.account.scholar.details')
	    <!-- Ends Panel -->
	</div>
	<!--Ends Column-->
	<div class="col-lg-8">
	    @include('student.account.scholar.about')
	    @include('student.account.scholar.contact')
	   {{--  @include('student.account.scholar.reviews') --}}
	</div>
@stop