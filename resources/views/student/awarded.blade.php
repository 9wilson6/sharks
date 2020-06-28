@extends('layouts.masterback')
@section('title', 'Tutors: '.defaultsettings()['sitename'])
@section('heading', 'Tutor awarded orders')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Tutor awarded orders ({{ $tutor->fullname }})</h4></div>
        <div class="panel-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif
            @if(session('status'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong> {{ session('status') }}</strong>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th scope="col">Order #</th>
                        <th scope="col">Subject</th>                    
                        <th scope="col">Title</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Created</th>
                        <th scope="col">Bids</th>
                    </tr>
                    @foreach($tutor->orderawards as $order)
                    <tr>
                        <td><a href="#"><strong>{{ $order->id }}</strong></a></td>
                        <td>{{ $order->subject }}</td>
                        <td>{{ $order->title }}</td>
                        <td>{{ $order->budget }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td>
                        <td>{{ count($order->bids) }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop