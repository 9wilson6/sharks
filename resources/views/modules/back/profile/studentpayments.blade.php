<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Payment Transactions
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Project ID</th>
                <th scope="col">Payment To</th>
                <th scope="col">Amount</th>
            </tr>
            @foreach($studentpayments as $payment)
                <tr>
                    <td>{{ $payment->created_at }}</td>
                    <td>{{ $payment->order_no }}</td>
                    <td>{{ $payment->description }}</td>
                    <td>{{ $payment->paid_to }}</td>
                </tr>
            @endforeach
        </table>
        {{ $studentpayments->links() }}
    </div>
</div>
