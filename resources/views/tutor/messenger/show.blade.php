@extends('layouts.masterback')
@section('heading', $thread->subject)
@section('content')
    <div class="col-md-12">
        @each('tutor.messenger.partials.messages', $thread->messages, 'message')
        @include('tutor.messenger.partials.form-message')
    </div>
@stop
