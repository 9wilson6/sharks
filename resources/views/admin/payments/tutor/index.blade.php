@extends('layouts.masterback')
@section('title', 'Payments: '.defaultsettings()['sitename'])
@section('heading', 'Transaction history for tutor '.$tutor->fullname)
@section('content')
    <div class="col-lg-12">
        @include('admin.payments.tutor.withdrawhistory')
    </div>
    <div class="col-lg-12">
        @include('admin.payments.tutor.transaction')
    </div>
@stop
