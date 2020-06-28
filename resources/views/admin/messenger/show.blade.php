@extends('layouts.masterback')
@section('heading', $thread->subject)
@section('content')
    <div class="col-md-12">
        @each('admin.messenger.partials.messages', $thread->messages, 'message')
        @include('admin.messenger.partials.form-message')
    </div>
@stop