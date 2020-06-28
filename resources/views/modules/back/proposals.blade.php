<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Proposal Information
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th scope="col">Order # </th>
                <th scope="col">Proposal Amount</th>
                <th scope="col">Completion Date/Time </th>
                <th scope="col">Withdraw</th>
            </tr>
            @foreach($proposals as $proposal)
                <tr>
                    <td><a href="{{ url('/account/scholarview') }}/{{ $proposal->order_id }}"><strong>{{ $proposal->order_id }}</strong></a></td>
                    <td>{{ $proposal->amount }}</td>
                    <td>{{ $proposal->homedate }}</td>
                    <td><a class="btn btn-primary" href="#">Withdraw</a></td>
                </tr>
            @endforeach            
        </table>
        {{ $proposals->links() }}
    </div>
</div>
