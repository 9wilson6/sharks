@extends('layouts.masterback')
@section('title', 'Disputes: '.defaultsettings()['sitename'])
@section('heading', 'All Disputes & Refunds')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h4>All disputes <a href="{{ route('admin.refunds') }}" class="btn btn-primary"><strong>View all refunds</strong></a></h4></div>
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
                        <th scope="col">Tutor</th>
                        <th scope="col">Student</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Actions</th>
                    </tr>
                    @foreach($disputes as $dispute)
                    <tr>
                        <td><strong><a href="{{ route('admin.order', $dispute->order_id) }}">{{ $dispute->order_id }}</a></strong></td>
                        <td><a href="{{ route('admin.scholarprofile', $dispute->order->tutor->id) }}">{{ $dispute->order->tutor->name }}</a></td>
                        <td><a href="{{ route('admin.studentprofile', $dispute->order->student->id) }}">{{ $dispute->order->student->name }}</a></td>
                        <td>
                            @if (\Carbon\Carbon::parse($dispute->created_at)->addHours(24)->isPast())
                                <span class="label label-danger">Escalated</span>
                            @else
                                <span class="label label-warning"><strong>{{ \Carbon\Carbon::now()->diffInHours(\Carbon\Carbon::parse($dispute->created_at)->addHours(24), false) }} hours remaining</strong></span>
                            @endif
                            @if ($dispute->order->refund)
                                <span class="label label-success"><strong>Order was refunded by {{ $dispute->order->refund->refund_agent }} {{ \Carbon\Carbon::parse($dispute->order->refund->created_at)->diffForHumans() }}</strong></span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($dispute->created_at)->diffForHumans() }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.order', $dispute->order_id) }}" type="button" class="btn btn-xs btn-primary"><strong>Order details</strong></a>
                                @if ($dispute->order->refund)
                                    <button type="button" class="btn btn-xs btn-success"><strong>Refunded</strong></button>
                                @else
                                    <a href="{{ route('admin.dispute.refund', $dispute->order_id) }}" type="button" class="btn btn-xs btn-info" onclick="return confirm('Are you sure you want to refund this order? The tutor will be charge an escalation fee of $20 and the order amount will be credited to the student account, Do you wish to proceed?');"><strong>Initiate refund</strong></a>
                                @endif
                                @if (!\Carbon\Carbon::parse($dispute->created_at)->addHours(24)->isPast() && !$dispute->order->refund)
                                    <a href="{{ route('admin.dispute.withdraw', $dispute->order_id) }}" type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to withdraw this dispute? Kindly allow the student to perform this action instead, Do you wish to proceed?');"><strong>Withdraw</strong></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{ $disputes->links() }}
        </div>
    </div>
</div>
@stop
