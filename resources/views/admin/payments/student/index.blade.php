@extends('layouts.masterback')
@section('title', 'Payments: '.defaultsettings()['sitename'])
@section('heading', 'Transaction history for student '.$student->fullname)
@section('content')
    <div class="col-lg-12">
        @include('admin.payments.student.withdrawhistory')
    </div>
    <div class="col-lg-12">
        @include('admin.payments.student.transaction')
    </div>
@stop
