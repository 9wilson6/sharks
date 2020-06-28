<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> Recent Orders - <a href="{{ url('/account/orders') }}"> View All </a>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <!-- <i>No Recent Projects</i>  -->
        <table class="table table-striped table-hover">
            <tbody>
                @if(count($orders) < 1)
                    <tr>
                        <em>There are no orders yet</em>
                    </tr>
                @else
                     <tr>
                        <th scope="col">Order #</th>
                        <th scope="col">Title</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Status</th>
                        <th scope="col">Bids </th>
                        <th scope="col"></th>
                    </tr>
                @endif                
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td><a href="{{ url('/account/studentview') }}/{{ $order->id }}">{{ $order->subject }}</a></td>
                            <td>{{ $order->homedate }}</td>
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
                                @elseif($order->status == 8)
                                  In Revision
                                @elseif($order->status == 6)
                                  Closed
                                @elseif($order->status == 7)
                                  Refunded
                                @endif
                            </td>
                            <td>{{ $account->no_bid($order->id) }}</td>
                            <td><a class="btn btn-primary" href="{{ url('/account/studentview') }}/{{ $order->id }}">Details</a></td>
                        </tr>
                    @endforeach            
            </tbody>
        </table>
    </div>
    <!-- /.panel-body -->
</div>