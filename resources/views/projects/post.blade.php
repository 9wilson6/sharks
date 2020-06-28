@extends('layouts.masterback')
@section('title', 'Homework Bubble: Get Instant Help')
@section('heading', 'Fill in all the fields')
@section('postproject')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
@stop
@section('content')
    <div class="col-lg-8">
        @include('projects.project')
    </div>
    <div class="col-lg-4">
        @include('projects.sidebar')
    </div>
@stop

