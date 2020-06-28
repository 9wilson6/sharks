@extends('layouts.masterback')
@section('title', 'My Payments: '.defaultsettings()['sitename'])
@section('heading', 'My Payments')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Payment Transactions</div>
            <div class="panel-body">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Description</th>
                        <th scope="col">Method</th>
                        <th scope="col">Transaction code</th>
                    </tr>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->created_at }}</td>
                            <td>Usd {{ $payment->amount }}</td>
                            <td>{{ $payment->description }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>{{ $payment->transaction_id }}</td>
                        </tr>
                    @endforeach
                </table>
                {{ $payments->links() }}
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Payment Withdrawals</div>
            <div class="panel-body">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Description</th>
                    </tr>
                    @foreach($withdrawals as $payment)
                        <tr>
                            <td>{{ $payment->created_at }}</td>
                            <td>Usd {{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->description }}</td>
                        </tr>
                    @endforeach
                </table>
                {{ $withdrawals->links() }}
            </div>
        </div>
    </div>
@stop