@extends('layouts.masterorderstudent')
@section('title', $order_id->title)
@section('heading', 'Order # '.$order_id->id.' -')
@section('header_id', $order_id->title)
@section('content')
@if (session('status'))
<div class="alert alert-success">
    <strong>{!!html_entity_decode(session('status'))!!}</strong>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    <strong>{!!html_entity_decode(session('error'))!!}</strong>
</div>
@endif
@if(Session::has('message'))
<div class="alert {{ Session::get('alert-class', 'alert-info') }}">
    <strong>{{ Session::get('message') }}</strong>
</div>
@endif
@include('student.orderdetails.progress')
<div id="student-order-view">
    <student-order-view :order="{{ $order_id }}" :user="{{ Auth::user() }}"></student-order-view>
</div>
@stop
