@extends('layouts.masterback')
@section('title', 'Find Projects: '.defaultsettings()['sitename'])
@section('heading', 'Find Orders')
@section('content')
    <div class="col-lg-9">
        @include('tutor.orders.findprojects.findprojects')
    </div>
    <div class="col-lg-3">
        @include('tutor.orders.findprojects.sidebar')
    </div>
@stop
