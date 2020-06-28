<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Account Balance
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>Account Balance:</td>
                <td><strong>USD {{ $tutor->tutorpayments->sum('amount') - $tutor->tutorwithdrawals->sum('amount') }}</strong></td>
            </tr>
            <tr>
                <td>Payment method</td>
                <td><strong>{{ $tutor->profile->payment_method }}</strong>
        </table>
        <h3>Withdrawal History</h3>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Payment method</th>
                <th scope="col">Transaction code</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
                <th scope="col">Fee</th>
                <th scope="col">Total</th>
            </tr>
            @foreach($withdrawals as $payment)
            <tr>
                <td>{{ $payment->created_at }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->transaction_id }}</td>
                <td>{{ $payment->description }}</td>
                <td>Usd {{ number_format($payment->amount, 2) }}</td>
                <td>Usd {{ number_format($payment->fee, 2) }}</td>
                <td><strong>Usd {{ number_format($payment->amount + $payment->fee, 2) }}</strong></td>
            </tr>
            @endforeach
        </table>
        {{ $withdrawals->links() }}
    </div>
</div>
