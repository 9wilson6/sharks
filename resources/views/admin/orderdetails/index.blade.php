@extends('layouts.masterordersadmin')
@section('title', $order_id->title)
@section('heading', 'Order # '.$order_id->id.' -')
@section('header_id', $order_id->title)
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        <strong>{{ session('status') }}</strong>
    </div>
@endif
@if (session('fail'))
    <div class="alert alert-danger">
        <strong>{{ session('fail') }}</strong>
    </div>
@endif
<div id="admin-order-view">
    <admin-order-view :order="{{ $order_id }}" :user="{{ Auth::user() }}"></admin-order-view>
</div>
@stop
