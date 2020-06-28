<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Account Balance
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>Account Balance:</td>
                <td><strong>USD {{ $student->studentpayments->sum('amount') - $student->studentwithdrawal->sum('amount') }}</strong></td>
            </tr>
        </table>
        <h3>Withdrawal History</h3>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Transaction code</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
            </tr>
            @foreach($withdrawals as $payment)
            <tr>
                <td>{{ $payment->created_at }}</td>
                <td>{{ $payment->transaction_id }}</td>
                <td>{{ $payment->description }}</td>
                <td>Usd {{ number_format($payment->amount, 2) }}</td>
            </tr>
            @endforeach
        </table>
        {{ $withdrawals->links() }}
    </div>
</div>
