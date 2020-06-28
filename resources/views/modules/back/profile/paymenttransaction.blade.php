<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Payment Transactions
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Project ID</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
                <th scope="col">Fee</th>
                <th scope="col">Total</th>
            </tr>
            @foreach($tutorpayments as $pay)
            <tr>
                <td>{{ $pay->created_at }}</td>
                <td>{{ $pay->order_no }}</td>
                <td>{{ $pay->description }}</td>
                <td>{{ number_format($pay->amount, 2) }}</td>
                <td>{{ number_format($pay->fee, 2) }}</td>
                <td>{{ number_format($pay->amount, 2) }}</td>
            </tr>
            @endforeach
        </table>
        {{ $tutorpayments->links() }}
    </div>
</div>
