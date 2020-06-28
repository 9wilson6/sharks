@extends('layouts.masterback')
@section('heading') Messages @stop

@section('content')
    <div class="col-lg-12">
    <div class="col-lg-6">
    <a class="btn btn-primary" href="/messages/create">Compose Message</a>
        
    </div>
    <div class="col-lg-6">
    <a class="btn btn-primary" href="/messages/create/admin">Contact Support</a>
        
    </div>
        
    </div>
    <p></p>
    <hr>
    <hr>
    @include('messenger.partials.flash')
    <p></p>
    <hr>


    @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
@stop
