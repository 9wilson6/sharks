@extends('layouts.masterback')
@section('title', 'Refunds: '.defaultsettings()['sitename'])
@section('heading', 'All refunds for the last 30 days')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>All refunds for the last 30 days</h4>
        </div>
        <div class="panel-body">
            @if(session('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ session('error') }}</strong>
            </div>
            @endif @if(session('status'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> {{ session('status') }}</strong>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th scope="col">Order #</th>
                        <th scope="col">Tutor</th>
                        <th scope="col">Student</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Actions</th>
                    </tr>
                    @foreach(tutorefunds(Auth::user()->id) as $refund)
                    <tr>
                        <td><strong><a href="{{ route('tutor.order', $refund['order_id']) }}">{{ $refund['order_id'] }}</a></strong></td>
                        <td><a href="{{ route('tutor.scholarprofile', $refund->order->tutor->id) }}">{{ $refund->order->tutor->name }}</a></td>
                        <td><a href="{{ route('tutor.studentprofile', $refund->order->student->id) }}">{{ $refund->order->student->name }}</a></td>
                        <td>{{ \Carbon\Carbon::parse($refund->created_at)->diffForHumans() }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('tutor.order', $refund['order_id']) }}" type="button" class="btn btn-xs btn-primary"><strong>Order Details</strong></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@stop
