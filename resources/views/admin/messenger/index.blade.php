@extends('layouts.masterback')
@section('heading', 'Messages')
@section('content')
<div class="col-lg-12">
    <div class="alert alert-info">
        A mesage will be sent to all students/tutors without adding all participants
    </div>
    <div class="col-lg-4">
        <a class="btn btn-primary" href="{{ route('admin.messages.create.group', 'students') }}">Send message to all students</a>
    </div>
    <div class="col-lg-4">
        <a class="btn btn-primary" href="{{ route('admin.messages.create.group', 'tutors') }}">Send message to all tutors</a>
    </div>
    <div class="col-lg-4">
        <a class="btn btn-primary" href="{{ route('admin.messages.all') }}">See all messages</a>
    </div>
</div>
<hr>
@include('student.messenger.partials.flash')
<p></p>
<hr>
@each('admin.messenger.partials.thread', $threads, 'thread', 'admin.messenger.partials.no-threads')
{{ $threads->links() }}
@stop 
