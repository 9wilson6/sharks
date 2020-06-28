<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Account Balance
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>Account Balance:</td>
                <td><strong>USD {{ number_format(Auth::user()->tutorpayments->sum('amount') - Auth::user()->tutorwithdrawals->sum('amount') ,2) }}</strong></td>
            </tr>
            <tr>
                <td>Payment method</td>
                <td><strong>{{ Auth::user()->profile->payment_method }}</strong>
        </table>
        <h3>Withdrawal History</h3>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Payment method</th>
                <th scope="col">Transaction code</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
            </tr>
            @foreach($withdrawals as $payment)
            <tr>
                <td>{{ $payment->created_at }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->transaction_id }}</td>
                <td>{{ $payment->description }}</td>
                <td>Usd {{ number_format($payment->amount, 2) }}</td>
            </tr>
            @endforeach
        </table>
        {{ $withdrawals->links() }}
    </div>
</div>
