@extends('layouts.masterback')
@section('heading') {{ $thread->subject }} @stop

@section('content')
    <div class="col-md-12">
        @each('messenger.partials.messages', $thread->messages, 'message')

        @include('messenger.partials.form-message')
    </div>
@stop
