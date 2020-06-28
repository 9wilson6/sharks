@extends('layouts.masterback')
@section('title', 'My Orders: '.defaultsettings()['sitename'])
@section('heading', 'Orders')
@section('content')
    <div class="col-lg-12">
        @include('student.orders.active')
        @include('student.orders.closed')
    </div>
@stop