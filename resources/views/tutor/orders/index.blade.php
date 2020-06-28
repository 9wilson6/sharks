@extends('layouts.masterback')
@section('title', 'My Account: '.defaultsettings()['sitename'])
@section('heading', 'Myaccount')
@section('content')
    <div class="col-lg-12">
        @include('tutor.orders.active')
        @include('tutor.orders.closed')
    </div>
@stop