@extends('layouts.masterback')
@section('title', 'Payments: '.defaultsettings()['sitename'])
@section('heading', 'My Payments')
@section('content')
    <div class="col-lg-12">
        @include('tutor.payments.withdrawhistory')
    </div>
    <div class="col-lg-12">
        @include('tutor.payments.transaction')
    </div>
@stop