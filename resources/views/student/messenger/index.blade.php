@extends('layouts.masterback')
@section('heading', 'Messages')
@section('content')
<div class="col-lg-12">
    <div class="col-lg-6">
        <a class="btn btn-primary" href="{{ route('student.messages.create', 'support') }}">Contact Support</a>
    </div>
</div>
<hr>
@include('student.messenger.partials.flash')
<p></p>
<hr>
@each('student.messenger.partials.thread', $threads, 'thread', 'student.messenger.partials.no-threads')
{{ $threads->links() }}
@stop
