@extends('layouts.masterback')
@section('heading', $thread->subject)
@section('content')
    <div class="col-md-12">
        @each('student.messenger.partials.messages', $thread->messages, 'message')
        @include('student.messenger.partials.form-message')
    </div>
@stop
