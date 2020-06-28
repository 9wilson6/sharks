<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Payment Transactions
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Payment method</th>
                <th scope="col">Transaction code</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
            </tr>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->created_at }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->transaction_id }}</td>
                    <td>{{ $payment->description }}</td>
                    <td>Usd {{ number_format($payment->amount, 2) }}</td>
                </tr>
            @endforeach
        </table>
        {{ $payments->links() }}
    </div>
</div>
