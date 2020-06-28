@extends('layouts.masterback')
@section('heading', 'Messages')
@section('content')
<div class="col-lg-12">
    <div class="col-lg-6">
        <a class="btn btn-primary" href="{{ route('tutor.messages.create', 'support') }}">Contact Support</a>
    </div>
</div>
<hr>
@include('tutor.messenger.partials.flash')
<p></p>
<hr>
@each('tutor.messenger.partials.thread', $threads, 'thread', 'tutor.messenger.partials.no-threads')
{{ $threads->links() }}
@stop
