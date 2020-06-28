<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th scope="col">Order #</th>
                <th scope="col">Subject</th>
                <th scope="col">Pages</th>
                <th scope="col">Budget</th>
                <th scope="col">Created</th>
                <th scope="col">Status</th>
                <th scope="col">Awarded to</th>
                <th scope="col">Agreed amount</th>
                <th scope="col">Bids</th>
                <th scope="col">Actions</th>
            </tr>
            @foreach($data['orders'] as $order)
            <tr>
                <td><a href="{{ route('admin.order', $order->id) }}"><strong>{{ $order->id }}</strong></a></td>
                <td><a href="{{ route('admin.order', $order->id) }}"><strong>{{ $order->subject }}</strong></a></td>
                <td>{{ $order->numpages }}</td>
                <td>{{ $order->budget }}</td>
                <td>{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td>
                <td>
                    @if ($order->status == 1)
                        <span class="label label-success">Active</span>                                
                    @endif
                    @if ($order->status == 2)
                        <span class="label label-danger">Cancelled</span>                                
                    @endif
                    @if ($order->status == 3)
                        <span class="label label-warning">Disputed</span>                                
                    @endif
                    @if ($order->status == 4)
                        <span class="label label-success">In progress</span>                                
                    @endif
                    @if ($order->status == 5)
                        <span class="label label-primary">Completed</span>                                
                    @endif
                    @if ($order->status == 6)
                        <span class="label label-primary">Closed</span>                                
                    @endif
                    @if ($order->status == 7)
                        <span class="label label-info">Refunded</span>                                
                    @endif
                    @if ($order->status == 8)
                        <span class="label label-info">Revision</span>                                
                    @endif
                </td>
                <td>
                    @if ($order->tutor)
                        {{ $order->tutor->name }}
                    @endif
                </td>
                <td>{{ $order->agreed_amount }}</td>
                <td><a href="{{ route('admin.bids.order', $order->id) }}"><strong>{{ count($order->bids) }}</strong></a></td>
                <td><a href="{{ route('admin.order', $order->id) }}" class="btn btn-primary btn-xs"><strong>Details</strong></a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>