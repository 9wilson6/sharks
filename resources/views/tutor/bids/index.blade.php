@extends('layouts.masterback')
@section('title', 'My bids: '.defaultsettings()['sitename'])
@section('heading', 'My bids')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-clock-o fa-fw"></i> Bids Information
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
                        <td><a href="{{ route('tutor.order', $bid->order_id) }}"><strong>{{ $bid->order_id }}</strong></a></td>
                        <td><a href="{{ route('tutor.order', $bid->order_id) }}"><strong>{{ $bid->order->title }}</strong></a></td>
                        <td>USD {{ $bid->amount }}</td>
                        <td>{{ $bid->order->homedate }}</td>
                        <td><a class="btn btn-primary" href="{{ route('bids.delete', $bid->order_id) }}" onclick="return confirm('Do you really want to Delete this bid?');">Withdraw</a></td>
                    </tr>
                @endforeach
            </table>
            {{ $bids->links() }}
        </div>
    </div>

</div>
@stop
