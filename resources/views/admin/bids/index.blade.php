@extends('layouts.masterback')
@section('title', 'Bids: '.defaultsettings()['sitename'])
@section('heading', 'Bids for order #'.$order_no)
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-clock-o fa-fw"></i> Bids for order #{{ $order_no }}
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th scope="col">Order # </th>
                    <th scope="col">Order title</th>
                    <th scope="col">Bid Amount</th>
                    <th scope="col">Completion Date/Time</th>
                    <th scope="col">Withdraw</th>
                </tr>
                @foreach($bids as $bid)
                    <tr>
                        <td><a href="{{ route('admin.order', $bid->order_id) }}"><strong>{{ $bid->order_id }}</strong></a></td>
                        <td><a href="{{ route('admin.order', $bid->order_id) }}"><strong>{{ $bid->order->title }}</strong></a></td>
                        <td>USD {{ $bid->amount }}</td>
                        <td>{{ $bid->order->homedate }}</td>
                        <td><a class="btn btn-primary" href="{{ route('admin.bids.delete', $bid->id) }}" onclick="return confirm('Do you really want to Delete this bid?');">Withdraw</a></td>
                    </tr>
                @endforeach
            </table>
            {{ $bids->links() }}
        </div>
    </div>

</div>
@stop
