@extends('layouts.masterorderstutor')
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
@if (session('error'))
    <div class="alert alert-danger">
        <strong>{{ session('error') }}</strong>
    </div>
@endif
<div id="tutor-order-view">
    <tutor-order-view :order="{{ $order_id }}" :user="{{ Auth::user() }}"></tutor-order-view>
</div>
@stop
