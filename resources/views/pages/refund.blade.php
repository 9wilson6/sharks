@extends('layouts.test')
@section('title', 'Myhomeworkshark: Refund Policy')
@section('content')
<div class="dzsparallaxer auto-init" data-options='{   direction: "reverse"}' style="height: 300px;">
    <div class="divimage dzsparallaxer--target " style="width: 101%; height: 600px; background-image: url({{ asset('img/bg2.jpg') }})">
    </div>
    <div class=" parallax-text center-it page-title text-center">
        <h1 class="text-uppercase">Refund Policy</h1>
    </div>
</div>
<div class="content-section-a" style="padding: 30px;">
    @include('modules.front.refund-policy')
</div>
@stop