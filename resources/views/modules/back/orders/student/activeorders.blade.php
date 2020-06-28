<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Active Orders
    </div>
    <div class="panel-body">
        <table class="table table-striped table-hover">
            <tbody>
            @if(count($activeorders) < 1)
                    <tr>
                        <em>There are no orders yet</em>
                    </tr>
                @else
                     <tr>
                        <th scope="col">Order #</th>
                        <th scope="col">Title</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Agreed Amount ($) </th>
                        <th scope="col">Status</th>
                        <th scope="col">Bids</th>
                    </tr>
                @endif                
                    @foreach($activeorders as $order)
                        <tr>
                            <td><strong>{{ $order->id }}</strong></td>
                            <td><a href="{{ url('/account/studentview') }}/{{ $order->id }}">{{ $order->subject }}</a></td>
                            <td>{{ $order->homedate }}</td>
                            <td>{{ number_format($order->agreed_amount, 2) }}</td>
                            <td>
                                @if($order->status == 1)
                                  Active
                                @elseif($order->status == 2)
                                  Cancelled
                                @elseif($order->status == 3)
                                  Disputed
                                @elseif($order->status == 4)
                                  In progress
                                @elseif($order->status == 5)
                                  Completed
                                @elseif($order->status == 6)
                                  Closed
                                @elseif($order->status == 7)
                                  Refunded
                                @elseif($order->status == 8)
                                  Revision
                                @endif
                            </td>
                            <td>{{ $account->no_bid($order->id) }}</td>
                            <td><a class="btn btn-primary" href="{{ url('/account/studentview') }}/{{ $order->id }}">Details</a></td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
